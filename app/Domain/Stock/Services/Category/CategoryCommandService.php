<?php

namespace App\Domain\Stock\Services\Category;

use App\Domain\Stock\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Stock\Requests\CategoryRequest;

class CategoryCommandService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $categoryRepository;

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
     * @param $id
     * @param CategoryRequest $request
     * @return Model
     */
    public function updateCategory($id, CategoryRequest $request): Model
    {
        return $this->categoryRepository
            ->update($request->validated(), $id);
    }

    /**
     * @param $id
     * @return int
     */
    public function destroyCategory($id): int
    {
        return $this->categoryRepository->destroy($id);
    }
}
