<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    protected $fillable = [
		'recipe_id',
		'name',
		'instruction',
		'position',
	];

    public $timestamps = false;

	public function recipe()
	{
		return $this->belongsTo('App\Models\Recipe');
	}

}
