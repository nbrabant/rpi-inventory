<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecetteProduit extends Model
{
	protected $table = 'recettes_produits';

	//columns
    protected $fillable = [
		'recette_id',
		'produit_id',
		'quantite',
	];

	public $timestamps = false;

	//hierarchical
	public function recette() {
		return $this->belongsTo('App\Recette');
	}

	public function produit() {
		return $this->belongsTo('App\Produit');
	}

	public function getUniteList()
	{
		return [
			'' 					=> '---',
			'grammes' 			=> 'Grammes',
			'litre' 			=> 'Litre',
			'centilitre' 		=> 'Centilitre',
			'cuillere_soupe' 	=> 'Cuillere à Soupe',
			'cuillere_dessert' 	=> 'Cuillere à Dessert',
			'cuillere_cafe' 	=> 'Cuillere à Cafe',
			'sachet' 			=> 'Sachet'
		];
	}

	// verbose unity

	// convert quantity
	// http://tout-metz.com/recette/conversion-unite-cuisine
}
