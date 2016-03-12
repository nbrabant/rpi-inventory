<?php

Route::bind('categorie', function ($id) {
	return App\Categorie::whereId($id)->first();
});

Route::bind('produit', function($id){
	return App\Produit::whereId($id)->first();
});

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');

Route::any('liste-courses', 'ListesController@index');
Route::post('listes/addProducts', 'ListesController@ajoutproduits');
Route::get('listes/delProducts/{id}', 'ListesController@deleteproduits');
Route::get('listes/changeQty/{type}/{id}', 'ListesController@changequantity');
Route::get('listes/endingList', 'ListesController@endinglist');
Route::get('listes/export/{type}', 'ListesController@export');

Route::get('categories', 'CategoriesController@index');
Route::get('categories/show/{categorie}', 'CategoriesController@show');
Route::any('categories/add', 'CategoriesController@add');
Route::any('categories/edit/{categorie}', 'CategoriesController@edit');

Route::get('produits', 'ProduitsController@index');
Route::any('produits/show/{produit}', 'ProduitsController@show');
Route::any('produits/add', 'ProduitsController@add');
Route::any('produits/edit/{produit}', 'ProduitsController@edit');
Route::any('produits/addToCart/{produit}', 'ProduitsController@addToCart');

Route::get('autocomplete', function() {
    return View::make('autocomplete');
});

Route::get('getdata', function() {
    $term = strtolower(Input::get('term'));
    $return_array = array();

	$products = App\Produit::where('nom', 'LIKE', '%'.$term.'%')->get();
    foreach ($products as $product) {
        $return_array[] = array(
			'id' => $product->id,
			'value' => $product->nom,
		);
    }
    return Response::json($return_array);
});
