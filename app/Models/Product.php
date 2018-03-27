<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent {

	//columns
    protected $fillable = [
		'categorie_id',
		'nom',
		'description',
		'quantite',
		'quantite_min',
		'unite'
	];

	//hierarchical
	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}

	public function operations()
	{
		return $this->hasMany('App\Models\Operation');
	}

	public function productLine()
	{
		return $this->hasMany('App\Models\ProductLine');
	}

	public function recipes()
	{
		return $this->hasMany('App\Models\RecipeProduct');
	}

	// scope functions
	public function scopeWithoutIds($query, $ids = [])
	{
		if (is_array($ids) && !empty($ids)) {
			$query->whereNotIn('id', $ids);
		}
		return $query;
	}

	public static function getList($withoutId = null, $emptyLine = true)
	{
		$return = [];
		if($emptyLine) {
			$return['-1'] = '---';
		}

		static::without($withoutId)->get()->map(function($item) use (&$return) {
            $return[$item->id] = $item->nom;
        });

		return $return;
	}

	public function getStatus()
	{
		if ($this->quantite_min == 0 || $this->quantite > $this->quantite_min) {
			return 'alert-success';
		} elseif ($this->quantite == $this->quantite_min) {
			return 'alert-warning';
		}
		return 'alert-danger';
	}

	// récup des produits avec stock > stock mini hors produit dans la liste
	public static function getOutOfStockProducts($withoutIds = [])
	{
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

	public function toArray()
	{
		$datas = parent::toArray();

		$datas['status'] = $this->getStatus();

		return $datas;
	}
}
