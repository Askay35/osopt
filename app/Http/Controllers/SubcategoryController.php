<?php

namespace App\Http\Controllers;

use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('category_id')) {
            $subcategories = Subcategory::where('category_id',$request->get('category_id'))->get();
            if ($subcategories) {
                return response()->json(['status' => true, 'data' => $subcategories]);
            }
            return response()->json(['status' => false]);
        }
        return response()->json(['status' => true, 'data' => Subcategory::all()]);
    }
}
