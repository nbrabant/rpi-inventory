<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;
use App\Helpers\TrelloTraitHelper;

class Cart extends Eloquent
{
	use TrelloTraitHelper;

    protected $fillable = [
		'finished',
		'trello_card_id'
	];

	public function productLines()
	{
		return $this->hasMany('App\Models\ProductLine');
	}

	public function getProductListIds()
	{
		return $this->productLines()->lists('product_id')->toArray();
	}

	public function getProductsOrderedByCategory()
	{
		return $this->productLines()->with([
			'product',
			'product.category' => function($query) {
				$query->orderBy('position', 'ASC');
			}
		])->get();
	}

}
