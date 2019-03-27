<?php

namespace App\Interfaces\Http\Resources;

use Illuminate\Http\Request;
use App\Interfaces\Http\Controllers\Controller;

use App\Domain\Recipe\Services\RecipeCommandService;
use App\Domain\Recipe\Services\RecipeQueryService;

/**
 * @property RecipeCommandService recipe_command_service
 * @property RecipeQueryService recipe_query_service
 */
class Recipes extends Controller
{
    public function __construct(
        RecipeCommandService $recipe_command_service, 
        RecipeQueryService $recipe_query_service
    ) {
        $this->recipe_command_service = $recipe_command_service;
        $this->recipe_query_service = $recipe_query_service;
    }

    public function index(Request $request)
    {
        return $this->recipe_query_service->getRecipes($request);
    }

    public function create(Request $request)
    {
        return $this->recipe_command_service->initializeRecipe($request);
    }

    public function store(Request $request)
    {
        return $this->recipe_command_service->createRecipe($request);
    }

    public function show($id, Request $request)
    {
        return $this->recipe_query_service->getRecipe($id, $request);
    }

    public function update(Request $request, $id)
    {
        return $this->recipe_command_service->updateRecipe($id, $request);
    }

    public function destroy($id)
    {
        return $this->recipe_command_service->destroyRecipe($id);
    }
}
