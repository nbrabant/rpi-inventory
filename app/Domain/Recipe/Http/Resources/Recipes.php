<?php

namespace App\Domain\Recipe\Http\Resources;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Recipe\Services\RecipeCommandService;
use App\Domain\Recipe\Services\RecipeQueryService;

/**
 * @property RecipeCommandService recipeCommandService
 * @property RecipeQueryService recipeQueryService
 */
class Recipes extends Controller
{
    public function __construct(
        RecipeCommandService $recipeCommandService,
        RecipeQueryService $recipeQueryService
    ) {
        $this->recipeCommandService = $recipeCommandService;
        $this->recipeQueryService = $recipeQueryService;
    }

    public function index(Request $request)
    {
        return $this->recipeQueryService->getRecipes($request);
    }

    public function create(Request $request)
    {
        return $this->recipeCommandService->initializeRecipe($request);
    }

    public function store(Request $request)
    {
        return $this->recipeCommandService->createRecipe($request);
    }

    public function show($id, Request $request)
    {
        return $this->recipeQueryService->getRecipe($id, $request);
    }

    public function update(Request $request, $id)
    {
        return $this->recipeCommandService->updateRecipe($id, $request);
    }

    public function destroy($id)
    {
        return $this->recipeCommandService->destroyRecipe($id);
    }
}
