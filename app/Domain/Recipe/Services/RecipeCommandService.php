<?php

namespace App\Domain\Recipe\Services;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Entities\Recipe;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Recipe\Contracts\RecipeRepositoryInterface;
use App\Domain\Recipe\Requests\RecipeRequest;

/**
 * @property RecipeRepositoryInterface $recipeRepository
 */
class RecipeCommandService
{
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
    public function createRecipe(RecipeRequest $request): RecipeInterface
    {
        $attributes = $request->validated();

        $recipe = $this->recipeRepository->create($attributes);
        $recipe = $this->updateProductsAndSteps($recipe, $attributes);

        return $recipe;
    }

    /**
     * @param int $id
     * @param RecipeRequest $request
     * @return Recipe
     */
    public function updateRecipe(int $id, RecipeRequest $request): Recipe
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
     * @param int $id
     * @return int
     */
    public function destroyRecipe(int $id): int
    {
        return $this->recipeRepository->destroy($id);
    }

    /**
     * Update Recipe's Products and Steps
     *
     * @param RecipeInterface $recipe
     * @param mixed[] $attributes
     * @return RecipeInterface
     */
    private function updateProductsAndSteps(RecipeInterface $recipe, array $attributes): RecipeInterface
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
     * @param mixed[] $attributes
     * @return mixed[]
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
