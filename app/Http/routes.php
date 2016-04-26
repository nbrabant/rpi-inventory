<?php

Route::bind('categorie', function ($id) {
	return App\Categorie::whereId($id)->first();
});

Route::bind('produit', function($id){
	return App\Produit::whereId($id)->first();
});

Route::bind('recette', function($id){
	return App\Recette::whereId($id)->first();
});

Route::get('/', 'HomeController@index');
Route::get('home', 'HomeController@index');


Route::any('liste-courses', 'ListesController@index');
Route::group(['prefix' => 'listes-courses'], function () {
	Route::post('addProducts', 'ListesController@ajoutproduits');
	Route::any('createproduits', 'ListesController@createAndAddProduct');
	Route::get('delProducts/{id}', 'ListesController@deleteproduits');
	Route::get('changeQty/{type}/{id}', 'ListesController@changequantity');
	Route::get('endingList', 'ListesController@endinglist');
	Route::get('export/{type}', 'ListesController@export');
});

Route::get('categories', 'CategoriesController@index');
Route::get('categories/show/{categorie}', 'CategoriesController@show');
Route::any('categories/add', 'CategoriesController@add');
Route::any('categories/edit/{categorie}', 'CategoriesController@edit');
Route::post('sortlist', 'CategoriesController@sortlist');

Route::get('produits', 'ProduitsController@index');
Route::any('produits/show/{produit}', 'ProduitsController@show');
Route::any('produits/add', 'ProduitsController@add');
Route::any('produits/edit/{produit}', 'ProduitsController@edit');
Route::any('produits/addToCart/{produit}', 'ProduitsController@addToCart');
Route::get('autocomplete', 'ProduitsController@autocomplete');
Route::get('getdata', 'ProduitsController@getProducts');
Route::any('consomation', 'ProduitsController@consomation');
Route::any('consomation/productDetails/{produit}', 'ProduitsController@consomationDetails');

Route::get('recettes', 'RecettesController@index');
Route::group(['prefix' => 'recettes'], function () {
	Route::get('show/{recette}', 'RecettesController@show');
	Route::any('add', 'RecettesController@add');
	Route::any('edit/{recette}', 'RecettesController@edit');
	Route::any('recherche', 'RecettesController@recherche');
	Route::any('apisearch', 'RecettesController@apisearch');
});
