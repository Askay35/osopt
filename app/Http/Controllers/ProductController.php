<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        return response()->json(['status'=>true, 'data'=>Product::all()]);
    }
    public function show($id){
        $product = Product::find($id);
        if($product){
            return response()->json(['status'=>true, 'data'=>$product]);
        }
        return response()->json(['status'=>false, 'message'=>'Такого продукта нет']);
    }
}
