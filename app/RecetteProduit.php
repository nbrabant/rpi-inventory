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
	public function getQuantity()
	{
		if ($this->unite == 'centilitre') {
			return $this->quantite * 0.1;
		} elseif ($this->unite == 'cuillere_cafe') {
			return $this->quantite * 4;
		} elseif ($this->unite == 'cuillere_dessert') {
			return $this->quantite * 8;
		} elseif ($this->unite == 'cuillere_soupe') {
			return $this->quantite * 12;
		} elseif ($this->unite == 'verre_liqueur') {
			return $this->quantite * 0.03;
		} elseif ($this->unite == 'tasse_cafe') {
			return $this->quantite * 0.1;
		} elseif ($this->unite == 'verre_moutarde') {
			return $this->quantite * 0.15;
		} elseif ($this->unite == 'grand_verre') {
			return $this->quantite * 0.25;
		} elseif ($this->unite == 'bol') {
			return $this->quantite * 0.35;
		}
		return $this->quantite;
	}
}
