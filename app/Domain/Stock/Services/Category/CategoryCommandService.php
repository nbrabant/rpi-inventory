<?php

namespace App\Domain\Stock\Services\Category;

use App\Domain\Stock\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Stock\Http\Requests\CategoryRequest;

/**
 * @property CategoryRepositoryInterface $categoryRepository
 */
class CategoryCommandService
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
     * @return Model
     */
    public function initializeCategory(): Model
    {
        return $this->categoryRepository->initialize();
    }

    /**
     * @param CategoryRequest $request
     * @return Model
     */
    public function createCategory(CategoryRequest $request): Model
    {
        return $this->categoryRepository
            ->create($request->validated());
    }

    /**
     * @param int $id
     * @param CategoryRequest $request
     * @return Model
     */
    public function updateCategory(int $id, CategoryRequest $request): Model
    {
        return $this->categoryRepository
            ->update($request->validated(), $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroyCategory(int $id): int
    {
        return $this->categoryRepository->destroy($id);
    }
}
