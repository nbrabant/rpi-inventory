<?php namespace App\Http\Controllers\Api;

use App\Product;
use App\Http\Controllers\RestController;
use Illuminate\Http\Request;

class Products extends RestController
{
	const MODEL = Product::class;

	protected $validation = [
		'categorie_id'	=> 'required|integer',
		'nom' 			=> 'required|string',
		'description'	=> 'required|string',
		'quantite'		=> 'required|integer',
		'quantite_min'	=> 'required|integer',
		'unite'			=> 'required|integer',
	];

}