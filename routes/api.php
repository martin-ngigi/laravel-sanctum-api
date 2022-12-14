<?php

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
 */
//http://127.0.0.1:8000/api/products
Route::get('/products', function () {
    return Product::all();
});

/**
 * Post product
 */
Route::post('/products', function () {
    return Product::create([
        'name' => 'Product One',
        'slug' => 'Product-one',
        'description' => 'This is product description',
        'price' => '99.99',
    ]);
});
