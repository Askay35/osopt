<?php

use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::prefix("categories")->group(function(){
    Route::get('/', [CategoryController::class, 'index']);
});

Route::prefix("subcategories")->group(function(){
    Route::get('/', [SubcategoryController::class, "index"]);
});
Route::prefix("brands")->group(function(){
    Route::get('/', [BrandController::class, "index"]);
});

Route::prefix("products")->group(function(){
    Route::get('/', [ProductController::class, "index"]);
    Route::get('/{id}', [ProductController::class, "show"])->where('id', '[0-9]+');
    Route::get('/search', [ProductController::class, "search"]);
    Route::get('/search/autocomplete/{search}', [ProductController::class, "search_autocomplete"]);
});

Route::prefix("orders")->group(function(){
    Route::post('/', [\App\Http\Controllers\OrderController::class, "store"]);
});


