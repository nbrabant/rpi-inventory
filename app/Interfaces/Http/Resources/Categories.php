<?php

namespace App\Interfaces\Http\Resources;

use Illuminate\Http\Request;
use App\Interfaces\Http\Controllers\Controller;

use App\Domain\Stock\Services\Category\CategoryCommandService;
use App\Domain\Stock\Services\Category\CategoryQueryService;

/**
 * @property CategoryQueryService category_query_service
 * @property CategoryCommandService category_command_service
 */
class Categories extends Controller
{
    public function __construct(
        CategoryCommandService $category_command_service, 
        CategoryQueryService $category_query_service
    ) {
        $this->category_command_service = $category_command_service;
        $this->category_query_service = $category_query_service;
    }

    public function index(Request $request)
    {
        return $this->category_query_service->getCategories($request);
    }

    public function create(Request $request)
    {
        return $this->category_command_service->initializeCategory($request);
    }

    public function store(Request $request)
    {
        return $this->category_command_service->createCategory($request);
    }

    public function show(Request $request, $id)
    {
        return $this->category_query_service->getCategory($id, $request);
    }

    public function update(Request $request, $id)
    {
        return $this->category_command_service->updateCategory($id, $request);
    }

    public function destroy($id)
    {
        return $this->category_command_service->destroyCategory($id);
    }
}
