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
		'quantite_min',
		'unite'
	];

	protected $validators = [
		'nom'			=> 'required|string',
		'quantite'		=> 'integer',
		'quantite_min'	=> 'required|integer',
		'unite'			=> '',
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
		$return = [];
		if($emptyLine) {
			$return['-1'] = '---';
		}

		static::without($withoutId)->get()->map(function($item) use (&$return) {
            $return[$item->id] = $item->nom;
        });

		return $return;
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
		return self::withoutIds($withoutIds)
				->where('quantite_min', '>', 0)
				->whereRaw('produits.quantite <= produits.quantite_min')
				->get();
	}

	public function getUniteList()
	{
		return [
			'' 			=> '---',
			'grammes' 	=> 'Grammes',
			'litre' 	=> 'Litre',
			'sachet' 	=> 'Sachet'
		];
	}
}
