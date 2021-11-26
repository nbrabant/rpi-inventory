<?php

namespace App\Domain\Recipe\Http\Resources;

use App\Domain\Recipe\Contracts\RecipeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;
use App\Domain\Recipe\Services\RecipeCommandService;
use App\Domain\Recipe\Services\RecipeQueryService;
use App\Domain\Recipe\Http\Requests\RecipeRequest;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property RecipeCommandService recipeCommandService
 * @property RecipeQueryService recipeQueryService
 */
class Recipes extends Controller
{
    /**
     * @param RecipeCommandService $recipeCommandService
     * @param RecipeQueryService $recipeQueryService
     */
    public function __construct(
        RecipeCommandService $recipeCommandService,
        RecipeQueryService $recipeQueryService
    ) {
        $this->recipeCommandService = $recipeCommandService;
        $this->recipeQueryService = $recipeQueryService;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->recipeQueryService->getRecipes($request);
    }

    /**
     * @return Model
     */
    public function create(): Model
    {
        return $this->recipeCommandService->initializeRecipe();
    }

    /**
     * @param RecipeRequest $request
     * @return RecipeInterface
     */
    public function store(RecipeRequest $request): RecipeInterface
    {
        return $this->recipeCommandService->createRecipe($request);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Model
     */
    public function show(string $id, Request $request): Model
    {
        return $this->recipeQueryService->getRecipe($id, $request);
    }

    /**
     * @param RecipeRequest $request
     * @param int $id
     * @return RecipeInterface
     */
    public function update(RecipeRequest $request, int $id): RecipeInterface
    {
        return $this->recipeCommandService->updateRecipe($id, $request);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return $this->recipeCommandService->destroyRecipe($id);
    }
}
