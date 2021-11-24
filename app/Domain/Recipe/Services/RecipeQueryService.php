<?php

namespace App\Domain\Recipe\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Domain\Recipe\Contracts\RecipeRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property RecipeRepositoryInterface $recipeRepository
 */
class RecipeQueryService
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
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getRecipes(Request $request): LengthAwarePaginator
    {
        return $this->recipeRepository->getAll($request);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return Model
     */
    public function getRecipe(int $id, Request $request): Model
    {
        return $this->recipeRepository->find($id, $request);
    }
}
