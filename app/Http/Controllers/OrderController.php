<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        $rules = [
          "phone"=>"required|string|max:36|min:6",
          "products"=>"required|array",
          "payment_type"=>"required|exists:payment_types,id",
        ];
        $validator = Validator::make($data,$rules);
        if($validator->fails()){
            return response()->json(["status"=>false, "errors"=>$validator->errors()]);
        }

        $order = Order::create($data);
        foreach ($data['products'] as $product){
            DB::table('order_products')->insert(['order_id'=>$order->id,'product_id'=>$product['id'],'count'=>$product['count']]);
        }

        return response()->json(["status"=>true, 'data'=>$data]);
    }
}
