<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(){
        return response()->json(['status'=>true, 'data'=>Subcategory::all()]);
    }
    public function show($id){
        $category = Subcategory::find($id);
        if($category){
            return response()->json(['status'=>true, 'data'=>$category]);
        }
        return response()->json(['status'=>false, 'message'=>'Такой подкатегории нет']);
    }
}
