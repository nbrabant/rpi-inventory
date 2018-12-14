<?php

namespace App\Services\Recipe\Recipe;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Recipe\RecipeRepository as Recipe;

class RecipeQueryService
{
    private $recipe;

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    public function getRecipes(Request $request)
    {
        return $this->recipe->getAll($request);
    }

    public function getRecipe($id, Request $request)
    {
        return $this->recipe->find($id, $request);
    }
}
