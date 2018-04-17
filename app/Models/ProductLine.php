<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class ProductLine extends Eloquent {

	//columns
    protected $fillable = [
		'cart_id',
		'product_id',
		'quantity'
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
