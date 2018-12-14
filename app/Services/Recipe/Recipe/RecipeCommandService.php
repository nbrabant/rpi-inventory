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
        'name'                  => 'required|string',
        'recipe_type'           => 'required|in:entrée,plat,dessert',
        'instructions'          => 'required|string',
        'number_people'         => 'required|string|max:64',
        'preparation_time'      => 'integer',
        'cooking_time'          => 'integer',
        'complement'            => 'nullable|string',
        'products.*.product_id' => 'integer',
        'products.*.quantity'   => 'integer',
        // @TODO : define validation rule for product unit?
        'products.*.unit'       => 'nullable|string|in:grammes,litre,centilitre,cuilliere_cafe,cuilliere_dessert,cuilliere_soupe,verre_liqueur,verre_moutarde,grand_verre,tasse_cafe,bol,sachet,gousse',
        'steps.*.id'            => 'nullable|integer',
        'steps.*.name'          => 'string',
        'steps.*.instruction'   => 'string',
        'steps.*.position'      => 'integer|max:255',
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
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        $recipe = $this->recipe->update($attributes, $id);

        // if ($request->file('image') && $request->file('image')->isValid()) {
        //     $imageName = str_slug_fr($recipe->name).'-'.$recipe->id.'.'.$request->file('image')->getClientOriginalExtension();
        //
        //     $request->file('image')->move(
        //         base_path().'/public/brands', $imageName
        //     );
        //
        //     $recipe->visual = $request->file('image')->getClientOriginalExtension();
        //     $recipe->save();
        // }

        return $recipe;
    }

    public function destroyRecipe($id)
    {
        return $this->recipe->destroy($id);
    }
}
