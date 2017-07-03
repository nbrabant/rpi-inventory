<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent {

    protected $table = 'categories';

	//columns
    // protected $fillable = [
	// 	'nom',
	// 	'position'
	// ];

	// protected $validators = [
	// 	'nom' 		=> 'required',
	// 	'position' 	=> 'required',
	// ];

    //hierarchical
	public function products() {
		return $this->hasMany('App\Product');
	}

	// public function getValidators()
	// {
	// 	return $this->validators;
	// }

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
