<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Helpers\TrelloTraitHelper;

class Cart extends Eloquent
{
	use TrelloTraitHelper;

	//columns
    protected $fillable = [
		'finished',
		'trello_card_id'
	];

	//hierarchical
	public function productLines()
	{
		return $this->hasMany('App\Models\ProductLine');
	}

	public function listecourante() {
		return $this->hasMany('App\Listecourante');
	}

	public function getProductListIds()
	{
		return $this->lignesproduits()->lists('product_id')->toArray();
	}

	public function getProductsOrderedByCategory()
	{
		return $this->lignesproduits()->with([
			'product',
			'product.category' => function($query) {
				$query->orderBy('position', 'ASC');
			}
		])->get();
	}

}
