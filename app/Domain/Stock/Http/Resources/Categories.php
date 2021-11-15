<?php

namespace App\Domain\Stock\Http\Resources;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Stock\Services\Category\CategoryCommandService;
use App\Domain\Stock\Services\Category\CategoryQueryService;
use App\Domain\Stock\Requests\CategoryRequest;

/**
 * @property CategoryQueryService categoryQueryService
 * @property CategoryCommandService categoryCommandService
 */
class Categories extends Controller
{
    public function __construct(
        CategoryCommandService $categoryCommandService, 
        CategoryQueryService $categoryQueryService
    ) {
        $this->categoryCommandService = $categoryCommandService;
        $this->categoryQueryService = $categoryQueryService;
    }

    public function index(Request $request)
    {
        return $this->categoryQueryService->getCategories($request);
    }

    public function create()
    {
        return $this->categoryCommandService->initializeCategory();
    }

    public function store(CategoryRequest $request)
    {
        return $this->categoryCommandService->createCategory($request);
    }

    public function show(Request $request, $id)
    {
        return $this->categoryQueryService->getCategory($id, $request);
    }

    public function update(CategoryRequest $request, $id)
    {
        return $this->categoryCommandService->updateCategory($id, $request);
    }

    public function destroy($id)
    {
        return $this->categoryCommandService->destroyCategory($id);
    }
}
