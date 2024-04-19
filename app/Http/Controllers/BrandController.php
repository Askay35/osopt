<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BrandController extends Controller
{
    public function index(){
        return response()->json(['status'=>true, 'data'=>Cache::remember('categories', 600, function(){
            return Brand::all();            
        })]);
    }
}
