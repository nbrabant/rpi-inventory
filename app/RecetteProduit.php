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
}
