<?php namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Http\Controllers\RestController;
use Illuminate\Http\Request;

class Products extends RestController
{
	const MODEL = Product::class;

	protected $validation = [
		'categorie_id'	=> 'required|integer',
		'nom' 			=> 'required|string',
		'description'	=> 'required|string',
		'quantite_min'	=> 'required|integer',
		'unite'			=> 'string|in:piece,grammes,litre,sachet',
	];

	/**
	 * @override create method
	 *
	 * @return Product object
	 */
	public function create()
	{
		$model = static::MODEL;

		return new $model(['quantite' => 0]);
	}
}
