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
            "sorting" => "required|numeric|in:1,2,3,4",
            "subcategory_id" => "exists:subcategories,id",
            "per_page" => "required|min:1|max:100|numeric",
            "page" => "numeric",
        ];
        $validator = Validator::make($filters, $rules);
        if ($validator->fails()) {
            return response()->json(["status" => false, "errors" => $validator->errors()]);
        }

        $products_query = Product::where("in_stock",1);
        if ($filters['category_id'] != -1) {
            $products_query->where("category_id", $filters['category_id']);
            if (isset($filters['subcategory_id'])) {
                $products_query->where('subcategory_id', $filters['subcategory_id']);
            }
        }
        switch ($filters['sorting']) {
            case 2:
                $products_query->orderBy('price');
                break;
            case 3:
                $products_query->orderByDesc('price');
                break;
            case 4:
                $products_query->orderByDesc('name');
                break;

            default:
                break;
        }
        if (!isset($filters['page'])) {
            $filters['page'] = 1;
        }
        $offset = ($filters['page'] - 1) * $filters['per_page'];
        $products = $products_query->offset($offset)->limit($filters['per_page'])->get();
        return response()->json(['status' => true, 'data' => $products]);
    }

    public function search(Request $request)
    {
        $filters = $request->all();
        $rules = [
            "search" => "required|string",
            "category_id" => "required|numeric",
            "sorting" => "required|numeric|in:1,2,3,4",
            "subcategory_id" => "exists:subcategories,id",
            "per_page" => "required|min:1|max:100|numeric",
            "page" => "numeric",
        ];
        $validator = Validator::make($filters, $rules);
        if ($validator->fails()) {
            return response()->json(["status" => false, "errors" => $validator->errors()]);
        }

        $products_query = Product::where("in_stock",1);
        
        if ($filters['category_id'] != -1) {
            $products_query->where("category_id", $filters['category_id']);
            if (isset($filters['subcategory_id'])) {
                $products_query->where('subcategory_id', $filters['subcategory_id']);
            }
        }
        $products_query->where("name", "like", "%" . $filters['search'] . "%");
        
        switch ($filters['sorting']) {
            case 2:
                $products_query->orderBy('price');
                break;
            case 3:
                $products_query->orderByDesc('price');
                break;
            case 4:
                $products_query->orderBy('name');
                break;
            default:
                break;
        }

        if (!isset($filters['page'])) {
            $filters['page'] = 1;
        }
        $offset = ($filters['page'] - 1) * $filters['per_page'];
        $products = $products_query->offset($offset)->limit($filters['per_page'])->get();
        return response()->json(['status' => true, 'data' => $products]);
    }

    public function search_autocomplete($search)
    {
        $products_query = Product::where("in_stock",1);
        $products_query->where("name", "like", "%$search%");
        $products = $products_query->limit(5)->get('name')->toArray();
        return response()->json(['data' => $products ? $products : []]);
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
