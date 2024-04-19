<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CategoryController extends Controller
{
    public function index(){
        return response()->json(['status'=>true, 'data'=>Cache::remember('categories', 600, function(){
            return Category::all();            
        })]);
    }
    public function show($id){
        $category = Category::find($id);
        if($category){
            return response()->json(['status'=>true, 'data'=>$category]);
        }
        return response()->json(['status'=>false, 'message'=>'Такой категории нет']);
    }
}
