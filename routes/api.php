<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
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
// * NB: REMEBER TO ADD HEADERS IN POSTMAN ie Key-> Acceppt, Value-> application/json or change Accept =  */* from by unchecking it and another Accept

//http://127.0.0.1:8000/api/products
Route::post('/products',[ProductController::class, 'store']);

/**
 * get one product by id
 * 'show' is a method defined in ProductController
 * 'update'  is a method defined in ProductController
 * 'destroy' is a method defined in ProductController
 */
//http://127.0.0.1:8000/api/products/2
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::put('/products/{id}', [ProductController::class, 'update']);
Route::delete('/products/{id}', [ProductController::class, 'destroy']);
//http://127.0.0.1:8000/api/products/search?"name of product"
Route::get('/products/search/{name}', [ProductController::class,'search']);

/**
 * all of above get and post and CRUD routes can be replaced with a single resource
 * to check all routes, run in cmd:
 *                               php artisan route:list
 * Supported methods: GET, HEAD, PUT, PATCH, DELETE
 */
//http://127.0.0.1:8000/api/products-resource
Route::resource('/products-resource', ProductController::class);


//PROTECTED RPUTES... IE ONLY AUTHENTICATED USER CAN USE
Route::group(['middleware' => ['auth:sanctum']], function () {
    //http://127.0.0.1:8000/api/protected-products
    Route::get('/protected-products', [ProductController::class, 'index']);
    //logout
    //http://127.0.0.1:8000/api/logout
    Route::post('/logout',[AuthController::class, 'logout']);

});


//register
//http://127.0.0.1:8000/api/register
//'register' is a method defined in AuthController
Route::post('/register',[AuthController::class, 'register']);


//login
//http://127.0.0.1:8000/api/login
//'login' is a method defined in AuthController
Route::post('/login',[AuthController::class, 'login']);

