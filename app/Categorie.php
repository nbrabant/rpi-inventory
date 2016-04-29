<?php namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Categorie extends Eloquent {

    protected $table = 'categories';

	//columns
    protected $fillable = [
		'nom',
		'position'
	];

	protected $validators = [
		'nom' 		=> 'required',
		'position' 	=> 'required',
	];

    //hierarchical
	public function produits() {
		return $this->hasMany('App\Produit');
	}

	public function getValidators()
	{
		return $this->validators;
	}

	//scope functions
	public function scopeByPosition($query, $order = 'ASC') {
		if(!in_array($order, ['ASC', 'DESC'])){
			$order = 'ASC';
		}
		return $query->orderBy('position', $order);
	}

	public static function getList($emptyLine = true) {
        $return = [];
		if($emptyLine) {
			$return['-1'] = '---';
		}

        static::get()->map(function($item) use (&$return) {
            $return[$item->id] = $item->nom;
        });
        return $return;
	}


}
