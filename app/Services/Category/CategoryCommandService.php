<?php

namespace App\Services\Category;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\CategoryRepository as Category;
use Validator;

class CategoryCommandService
{
    private $category;

	protected $validation = [
        'nom' 		=> 'required|string|unique:categories,nom',
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
        $validator = Validator::make($request->all(), $this->validation);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors(), 401);
        }

        $attributes = $request->only(array_keys($this->validation));

        return $this->category->create($attributes);
    }

    public function updateCategory($id, Request $request)
    {
        $this->validation['nom'] .= ',' . $id;

        $validator = Validator::make($request->all(), $this->validation);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors(), 401);
        }

        $attributes = $request->only(array_keys($this->validation));

        return $this->category->update($attributes, $id);
    }

    public function destroyCategory($id)
    {
        return $this->category->destroy($id);
    }

}
