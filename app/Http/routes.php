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
Route::any('listes/createproduits', 'ListesController@createAndAddProduct');
Route::get('listes/delProducts/{id}', 'ListesController@deleteproduits');
Route::get('listes/changeQty/{type}/{id}', 'ListesController@changequantity');
Route::get('listes/endingList', 'ListesController@endinglist');
Route::get('listes/export/{type}', 'ListesController@export');

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
