<?php

use Illuminate\Http\Request;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
//
//
Route::group(['namespace' => 'Api'], function () {
    Route::resource('carts', 	    'Carts',           ['only' => ['show', 'update']]);
    Route::resource('cartproducts', 'CartProducts',    ['only' => ['store', 'update', 'destroy']]);
    Route::resource('categories', 	'Categories');
	Route::resource('products', 	'Products');
	Route::resource('consumptions', 'Consumptions',    ['only' => ['index', 'create', 'store', 'show']]);
	Route::resource('recipes',      'Recipes');
    Route::resource('schedules',    'Schedules',       ['except' => ['edit']]);
});
