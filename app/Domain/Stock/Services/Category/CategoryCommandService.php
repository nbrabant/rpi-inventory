<?php

namespace App\Domain\Stock\Services\Category;

use Illuminate\Http\Request;
use App\Domain\Stock\Repositories\CategoryRepository as Category;
use Validator;

class CategoryCommandService
{
    private $category;

    protected $validation = [
        'name' 		=> 'required|string|unique:categories,name',
        'position' 	=> 'required|integer',
    ];

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function initializeCategory(Request $request)
    {
        return $this->category->initialize();
    }

    public function createCategory(Request $request)
    {
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->category->create($attributes);
    }

    public function updateCategory($id, Request $request)
    {
        $this->validation['name'] .= ',' . $id;

        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->category->update($attributes, $id);
    }

    public function destroyCategory($id)
    {
        return $this->category->destroy($id);
    }
}
