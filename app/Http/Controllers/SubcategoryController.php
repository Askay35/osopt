<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('category_id')) {
    
            $subcategories = Cache::remember('subcategories:'.$request->get('category_id'), 600, function() use ($request){
                return Subcategory::where('category_id',$request->get('category_id'))->get();            
            }); 
            if ($subcategories) {
                return response()->json(['status' => true, 'data' => $subcategories]);
            }
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true, 'data' => Subcategory::all()]);
    }
}
