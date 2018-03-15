<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Services\Stock\Category\CategoryCommandService;
use App\Services\Stock\Category\CategoryQueryService;

class Categories extends Controller
{

	public function __construct(CategoryCommandService $category_command_service, CategoryQueryService $category_query_service)
    {
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
