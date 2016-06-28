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
		'unite',
	];

	public $timestamps = false;

	//hierarchical
	public function recette() {
		return $this->belongsTo('App\Recette');
	}

	public function produit() {
		return $this->belongsTo('App\Produit');
	}

	public static function getUniteList()
	{
		return [
			'' 					=> '---',
			'grammes' 			=> 'Grammes',
			'litre' 			=> 'Litre',
			'centilitre' 		=> 'Centilitre',
			'cuillere_cafe' 	=> 'Cuillere à Cafe',
			'cuillere_dessert' 	=> 'Cuillere à Dessert',
			'cuillere_soupe' 	=> 'Cuillere à Soupe',
			'verre_liqueur' 	=> 'Verre à liqueur',
			'verre_moutarde' 	=> 'Verre à moutarde',
			'grand_verre' 		=> 'Grand verre',
			'tasse_cafe' 		=> 'Tasse à café',
			'bol' 				=> 'Bol',
			'sachet' 			=> 'Sachet',
			'gousse' 			=> 'Gousse',
		];
	}

	public function getUnite()
	{
		return self::getUniteList()[$this->unite];
	}

	// verbose unity

	// convert quantity
	// http://tout-metz.com/recette/conversion-unite-cuisine
}
