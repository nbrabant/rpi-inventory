<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Ligneproduit extends Eloquent {

	protected $table = 'lignes_produits';

	//columns
    protected $fillable = [
		'liste_id',
		'produit_id',
		'quantite'
	];

	//hierarchical
	public function cart()
	{
		return $this->belongsTo('App\Cart');
	}

	public function product()
	{
		return $this->belongsTo('App\Product');
	}

	public function scopeCategoryByPosition($query)
	{
		return $query->with([
			'product',
			'product.category' => function($query) {
				$query->orderBy('position', 'ASC');
			}
		]);
	}

}
