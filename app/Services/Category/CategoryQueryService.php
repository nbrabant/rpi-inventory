<?php

namespace App\Services\Category;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\CategoryRepository as Category;

class CategoryQueryService
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getCategories(Request $request)
    {
        return $this->category->getAll($request);
    }

    public function getCategory($id, Request $request)
    {
        return $this->category->find($id, $request);
    }

}
