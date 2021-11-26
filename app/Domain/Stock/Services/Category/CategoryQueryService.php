<?php

namespace App\Domain\Stock\Services\Category;

use App\Domain\Stock\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property CategoryRepositoryInterface $categoryRepository
 */
class CategoryQueryService
{
    /**
     * @param CategoryRepositoryInterface $categoryRepository
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getCategories(Request $request): LengthAwarePaginator
    {
        return $this->categoryRepository->getAll($request);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Model
     */
    public function getCategory(string $id, Request $request): Model
    {
        return $this->categoryRepository->find($id, $request);
    }

}
