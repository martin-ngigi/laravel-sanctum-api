<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * get all products
 * 'index' is a method defined in ProductController
 */
//http://127.0.0.1:8000/api/products
Route::get('/products', [ProductController::class, 'index']);

/**
 * Post product
 * 'store is a method defined in the ProductController'
 */
// ** NB: REMEBER TO ADD HEADERS IN POSTMAN ie Key-> Acceppt, Value-> application/json or change Accept =  */* from by unchecking it and another Accept

//http://127.0.0.1:8000/api/products
Route::post('/products',[ProductController::class, 'store']);
