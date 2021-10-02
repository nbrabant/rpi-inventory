<?php

namespace App\Domain\Stock\Services\Category;

use App\Domain\Stock\Contracts\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

class CategoryCommandService
{
    /**
     * @var CategoryRepositoryInterface
     */
    private CategoryRepositoryInterface $categoryRepository;

    protected $validation = [
        'name' 		=> 'required|string|unique:categories,name',
        'position' 	=> 'required|integer',
    ];

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function initializeCategory(Request $request): Model
    {
        return $this->categoryRepository->initialize();
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function createCategory(Request $request): Model
    {
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->categoryRepository->create($attributes);
    }

    /**
     * @param $id
     * @param Request $request
     * @return Model
     */
    public function updateCategory($id, Request $request): Model
    {
        $this->validation['name'] .= ',' . $id;

        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->categoryRepository->update($attributes, $id);
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
