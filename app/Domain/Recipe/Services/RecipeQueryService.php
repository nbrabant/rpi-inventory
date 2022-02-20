<?php

namespace App\Domain\Recipe\Services;

use App\Infrastructure\Events\CleanCart;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Domain\Recipe\Contracts\RecipeRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class RecipeQueryService
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
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getRecipes(Request $request): LengthAwarePaginator
    {
        return $this->recipeRepository->getAll($request);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Model
     */
    public function getRecipe(string $id, Request $request): Model
    {
        return $this->recipeRepository->find($id, $request);
    }
}
