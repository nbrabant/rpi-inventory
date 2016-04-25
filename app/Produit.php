<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Produit extends Eloquent {

	protected $table = 'produits';

	//columns
    protected $fillable = [
		'categorie_id',
		'nom',
		'description',
		'quantite',
		'quantite_min'
	];

	protected $validators = [
		'nom'			=> 'required',
		'quantite'		=> 'required',
		'quantite_min'	=> 'required',
	];

	//hierarchical
	public function categorie() {
		return $this->belongsTo('App\Categorie');
	}

	public function operations() {
		return $this->hasMany('App\Operation');
	}

	public function lignesproduits() {
		return $this->hasMany('App\Ligneproduit');
	}

	public function recettes() {
		return $this->hasMany('App\RecetteProduit');
	}

	//scope functions
	public function scopeWithoutIds($query, $ids = []) {
		if(is_array($ids) && !empty($ids)){
			$query->whereNotIn('id', $ids);
		}
		return $query;
	}

	public function getValidators()
	{
		return $this->validators;
	}

	public static function getList($withoutId = null, $emptyLine = true) {
		$produits = self::without($withoutId)->get();

		$results = [];
		if($emptyLine) {
			$results['-1'] = '---';
		}

		foreach ($produits as $produit)  {
			$results[$produit->id] = $produit->nom;
		}
		return $results;
	}

	public function getStatus() {
		if($this->quantite_min == 0 || $this->quantite > $this->quantite_min) {
			return 'alert-success';
		} elseif ($this->quantite == $this->quantite_min) {
			return 'alert-warning';
		}
		return 'alert-danger';
	}

	// récup des produits avec stock > stock mini hors produit dans la liste
	public static function getOutOfStockProducts($withoutIds = []) {
		$produits = self::withoutIds($withoutIds)
				->where('quantite_min', '>', 0)
				->whereRaw('produits.quantite <= produits.quantite_min')
				->get();
		return $produits;
	}
}
