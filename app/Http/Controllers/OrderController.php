<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Telegram\Bot\Laravel\Facades\Telegram;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->all();
        $rules = [
            "phone" => "required|string|max:36|min:4",
            "products" => "required|array",
            "message"=>"string|max:512",
            "payment_type" => "required|string|max:100",
        ];
        $validator = Validator::make($data, $rules);
        if ($validator->fails()) {
            return response()->json(["status" => false, "errors" => $validator->errors()]);
        }

        $message = "*Заявка на покупку*\n\n";
        $message.= "Номер: `$data[phone]`\n\n";
        $message.= "Тип оплаты: $data[payment_type]\n\n";
        if(isset($data['message'])){
            $message.= $this->escapeMessage("Сообщение от клиента: $data[message]\n\n");
        }
        $message.= "Продукты:\n\n";
        $order = Order::create($data);
        $order_sum = 0;
        $insert_data = [];
        foreach ($data['products'] as $k=>$product) {
            $p = Product::find($product['id']);
            if($p){
                $price = $p->price * $product['product_count'];
                if($product['package'] && $p->count){
                    $price *= $p->count;
                }
                $order_sum += $price;
                $name = $this->escapeMessage($p->name);
                $message.= ($k + 1) . "\\) $name \\| $product[product_count] " . (($product['package'] && $p->count) ? "упаковок" : "шт\\.")  . " \\| $price руб\\.\n\n";        
                $insert_data[] = ['order_id' => $order->id, 'product_id' => $product['id'], 'count' => $product['count']];
            }
        }

        $message.= "\nОбщая сумма: *$order_sum* руб\\.\n";        
        
        $current_datetime = new DateTime('now');
        $message.= "Дата: " . $this->escapeMessage($current_datetime->format('Y-m-d H:i:s'));        
        
        $admins = config('telegram.admins');
        foreach ($admins as $admin){
            Telegram::sendMessage([
                'parse_mode'=>"MarkdownV2",
                'chat_id' => $admin,
                'text' => $message
            ]);
        }

        DB::table('order_products')->insert($insert_data);

        return response()->json(["status" => true]);
    }
    private function escapeMessage($message){
        return preg_replace('/([|{\[\]_~}+)(#>*`!=\-.])/','\\\\$1', $message);
    }
}
