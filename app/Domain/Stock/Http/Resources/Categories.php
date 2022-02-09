<?php

namespace App\Domain\Stock\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Stock\Services\Category\CategoryCommandService;
use App\Domain\Stock\Services\Category\CategoryQueryService;
use App\Domain\Stock\Http\Requests\CategoryRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class Categories extends Controller
{
    /**
     * @var CategoryCommandService $categoryCommandService
     */
    private CategoryCommandService $categoryCommandService;
    /**
     * @var CategoryQueryService $categoryQueryService
     */
    private CategoryQueryService $categoryQueryService;

    /**
     * @param CategoryCommandService $categoryCommandService
     * @param CategoryQueryService $categoryQueryService
     */
    public function __construct(
        CategoryCommandService $categoryCommandService, 
        CategoryQueryService $categoryQueryService
    ) {
        $this->categoryCommandService = $categoryCommandService;
        $this->categoryQueryService = $categoryQueryService;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->categoryQueryService->getCategories($request);
    }

    /**
     * @return Model
     */
    public function create(): Model
    {
        return $this->categoryCommandService->initializeCategory();
    }

    /**
     * @param CategoryRequest $request
     * @return Model
     */
    public function store(CategoryRequest $request): Model
    {
        return $this->categoryCommandService->createCategory($request);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Model
     */
    public function show(Request $request, string $id): Model
    {
        return $this->categoryQueryService->getCategory($id, $request);
    }

    /**
     * @param CategoryRequest $request
     * @param int $id
     * @return Model
     */
    public function update(CategoryRequest $request, int $id): Model
    {
        return $this->categoryCommandService->updateCategory($id, $request);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return $this->categoryCommandService->destroyCategory($id);
    }
}
