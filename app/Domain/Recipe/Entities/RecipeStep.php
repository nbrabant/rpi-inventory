<?php

namespace App\Domain\Recipe\Entities;

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
        return $this->belongsTo(Recipe::class);
    }
}
