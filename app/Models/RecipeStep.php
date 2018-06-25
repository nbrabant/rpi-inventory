<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    // columns
    protected $fillable = [
		'recipe_id',
		'name',
		'instruction',
		'position',
	];

    public $timestamps = false;

    //hierarchical
	public function recipe()
	{
		return $this->belongsTo('App\Models\Recipe');
	}

}
