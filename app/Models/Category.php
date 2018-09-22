<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Category extends Eloquent {

    public function __toString() {
        return $this->name;
    }

	//columns
    protected $fillable = [
		'name',
		'position'
	];

    //hierarchical
	public function products() {
		return $this->hasMany('App\Product');
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
            $return[$item->id] = $item->name;
        });
        return $return;
	}

}
