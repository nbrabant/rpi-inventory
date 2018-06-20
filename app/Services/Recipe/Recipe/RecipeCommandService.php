<?php

namespace App\Services\Recipe\Recipe;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Recipe\RecipeRepository as Recipe;
use Validator;

class RecipeCommandService
{
    private $recipe;

	protected $validation = [
        'name' 		=> 'required|string|unique:categories,name',
		'position' 	=> 'required|integer',
	];

    public function __construct(Recipe $recipe)
    {
        $this->recipe = $recipe;
    }

    public function initializeRecipe(Request $request)
    {
        return $this->recipe->initialize();
    }

    public function createRecipe(Request $request)
    {
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->recipe->create($attributes);
    }

    public function updateRecipe($id, Request $request)
    {
        $this->validation['name'] .= ',' . $id;

        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->recipe->update($attributes, $id);
    }

    public function destroyRecipe($id)
    {
        return $this->recipe->destroy($id);
    }

}
