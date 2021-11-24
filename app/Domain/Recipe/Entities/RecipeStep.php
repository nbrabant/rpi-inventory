<?php

namespace App\Domain\Recipe\Entities;

use App\Domain\Recipe\Contracts\RecipeInterface;
use Illuminate\Database\Eloquent\Model;

class RecipeStep extends Model
{
    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'recipe_id',
        'name',
        'instruction',
        'position',
    ];

    /**
     * @var bool $timestamps
     */
    public $timestamps = false;

    /**
     * @return RecipeInterface
     */
    public function recipe(): RecipeInterface
    {
        return $this->belongsTo(Recipe::class);
    }
}
