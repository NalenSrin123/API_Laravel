<?php

use App\Http\Controllers\ShopController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register AP
I routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(ShopController::class)->group(function(){
    Route::get('/getAll/v1','getAllShop');

    Route::get('/shop/v1','getShop');
    Route::post('/add-product/v1','addProduct');
    Route::post('/edit-product/v1/{shop}','EditProduct');
    Route::delete('/delete-product/v1/{id}','DeleteProduct');
    Route::get('/getAll/v1/limit/{limit}','GetLimit');
    Route::get('/getAll/v1/categories/{categories}','GetProductByCategories');
    
});
