<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Operation extends Eloquent {

	protected $table = 'operations';

    protected $fillable = [
		'product_id',
		'quantity',
		'operation',
		'detail'
	];

	public function product() {
		return $this->belongsTo('App\Product');
	}

	public function sumProductQuantity() {
		$count = 0;

		$operations = self::where('product_id', $this->product_id)->get();
		foreach ($operations as $operation) {
			if($operation->operation === '+') {
				$count += $operation->quantity;
			} else {
				$count -= $operation->quantity;
			}
		}

		return $count;
	}

}
