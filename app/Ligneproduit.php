<?php namespace App;

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
	public function liste()
	{
		return $this->belongsTo('App\Liste');
	}

	public function produit()
	{
		return $this->belongsTo('App\Produit');
	}

	public function scopeCategoryByPosition($query)
	{
		return $query->with([
			'produit',
			'produit.categorie' => function($query) {
				$query->orderBy('position', 'ASC');
			}
		]);
	}

}
