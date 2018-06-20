<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Recipe\Recipe\RecipeCommandService;
use App\Services\Recipe\Recipe\RecipeQueryService;

class Recipes extends Controller
{

    public function __construct(RecipeCommandService $recipe_command_service, RecipeQueryService $recipe_query_service)
    {
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

    public function show($id)
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
