<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Liste extends Eloquent {

	protected $table = 'listes';

	//columns
    protected $fillable = [
		'termine'
	];

	//hierarchical
	public function lignesproduits() {
		return $this->hasMany('App\Ligneproduit');
	}

	public function getProductListIds() {
		return $this->lignesproduits()->lists('produit_id')->toArray();
	}

	
}
