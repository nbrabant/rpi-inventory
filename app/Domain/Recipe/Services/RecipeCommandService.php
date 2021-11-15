<?php

namespace App\Domain\Recipe\Services;

use App\Domain\Recipe\Entities\Recipe;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Recipe\Contracts\RecipeRepositoryInterface;
use App\Domain\Recipe\Requests\RecipeRequest;

class RecipeCommandService
{
    /**
     * @var RecipeRepositoryInterface $recipeRepository
     */
    private RecipeRepositoryInterface $recipeRepository;

    /**
     * Create Cart Recipe Service instance.
     *
     * @param RecipeRepositoryInterface $recipeRepository
     */
    public function __construct(RecipeRepositoryInterface $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

    /**
     * @return Model
     */
    public function initializeRecipe(): Model
    {
        return $this->recipeRepository->initialize();
    }

    /**
     * @param RecipeRequest $request
     * @return Recipe
     */
    public function createRecipe(RecipeRequest $request): Recipe
    {
        $attributes = $request->validated();

        $recipe = $this->recipeRepository->create($attributes);
        $recipe = $this->updateProductsAndSteps($recipe, $attributes);

        return $recipe;
    }

    /**
     * @param $id
     * @param RecipeRequest $request
     * @return Recipe
     */
    public function updateRecipe($id, RecipeRequest $request): Recipe
    {
        $attributes = $request->validated();

        $recipe = $this->recipeRepository->update($attributes, $id);
        $recipe = $this->updateProductsAndSteps($recipe, $attributes);

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

    /**
     * @param $id
     * @return int
     */
    public function destroyRecipe($id): int
    {
        return $this->recipeRepository->destroy($id);
    }

    /**
     * Update Recipe's Products and Steps
     *
     * @param Recipe $recipe
     * @param array $attributes
     * @return Recipe
     */
    private function updateProductsAndSteps(Recipe $recipe, array $attributes): Recipe
    {
        $recipe = $this->recipeRepository->syncProducts(
            $recipe,
            $this->sanitizeAttribute($attributes['products'])
        );
        $recipe = $this->recipeRepository->syncSteps(
            $recipe,
            $this->sanitizeAttribute($attributes['steps'])
        );

        return $recipe;
    }

    /**
     * @param array $attributes
     * @return array
     */
    private function sanitizeAttribute(array $attributes = []): array
    {
        $return = [];

        $attributes = reset($attributes);
        foreach ($attributes as $column => $values) {
            foreach ($values as $key => $value) {
                @$return[$key][$column] = $value;
            }
        }

        return $return;
    }

}
