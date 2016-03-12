<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Categorie extends Eloquent {

    protected $table = 'categories';

	//columns
    protected $fillable = [
		'nom',
		'position'
	];

    //hierarchical
	public function produits() {
		return $this->hasMany('App\Produit');
	}

	//scope functions
	public function scopeByPosition($query, $order = 'ASC') {
		if(!in_array($order, ['ASC', 'DESC'])){
			$order = 'ASC';
		}
		return $query->orderBy('position', $order);
	}

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
