<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Operation extends Eloquent {

	protected $table = 'operations';

	//columns
    protected $fillable = [
		'produit_id',
		'quantite',
		'operation',
		'detail'
	];

	//hierarchical
	public function produit() {
		return $this->belongsTo('App\Produit');
	}

	public function sumProductQuantity() {
		$count = 0;

		$operations = self::where('produit_id', $this->produit_id)->get();
		foreach ($operations as $operation) {
			if($operation->operation === '+') {
				$count += $operation->quantite;
			} else {
				$count -= $operation->quantite;
			}
		}

		return $count;
	}

}
