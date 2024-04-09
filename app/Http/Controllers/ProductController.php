<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->all();
        $rules = [
            "category_id" => "required|numeric",
            "subcategory_id" => "exists:subcategories,id",
            "per_page" => "required|min:1|max:100|numeric",
            "page" => "numeric",
        ];
        $validator = Validator::make($filters, $rules);
        if ($validator->fails()) {
            return response()->json(["status" => false, "errors" => $validator->errors()]);
        }

        $products_query = Product::query();
        if ($filters['category_id'] != -1) {
            $products_query = Product::where("category_id", $filters['category_id']);
            if (isset($filters['subcategory_id'])) {
                $products_query->where('subcategory_id', $filters['subcategory_id']);
            }
        }
        if (!isset($filters['page'])) {
            $filters['page'] = 1;
        }
        $offset = ($filters['page'] - 1) * $filters['per_page'];
        $products = $products_query->offset($offset)->limit($filters['per_page'])->get();
        return response()->json(['status' => true, 'data' => $products]);
    }
    public function show($id)
    {
        $product = Product::find($id);
        if ($product) {
            return response()->json(['status' => true, 'data' => $product]);
        }
        return response()->json(['status' => false, 'message' => 'Такого продукта нет']);
    }
}
