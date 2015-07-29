<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Categorie extends Eloquent {

    protected $table = 'categories';

	//columns
    protected $fillable = [
		'nom'
	];

    //hierarchical
	public function produits() {
		return $this->hasMany('App\Produit');
	}

	//scope functions

	public static function getList($emptyLine = true) {
		$categories = self::all();

		$results = [];
		if($emptyLine) {
			$results['-1'] = '---';
		}

		foreach ($categories as $categorie)  {
			$results[$categorie->id] = $categorie->nom;
		}
		return $results;
	}
}