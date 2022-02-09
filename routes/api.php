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

Route::namespace('\App\Domain\Cart\Http\Resources')
    ->group(function () {
        Route::resource('carts', 'Carts', ['only' => ['show', 'update']]);
        Route::resource('cartproducts', 'CartProducts', ['only' => ['store', 'update', 'destroy']]);
    });

Route::namespace('\App\Domain\Recipe\Http\Resources')
    ->group(function() {
        Route::resource('recipes', 'Recipes');
    });

Route::namespace('\App\Domain\Stock\Http\Resources')
    ->group(function() {
        Route::resource('categories', 'Categories');
        Route::resource('products', 'Products');
        Route::resource('consumptions', 'Consumptions', ['only' => ['index', 'create', 'store', 'show']]);
    });

Route::namespace('\App\Domain\Schedule\Http\Resources')
    ->group(function() {
        Route::resource('schedules', 'Schedules', ['except' => ['edit']]);
    });

Route::namespace('\App\Domain\Configuration\Http\Resources')
    ->group(function() {
        Route::resource('configurations', 'Configurations', ['only' => ['show', 'store']]);
    });