<?php

namespace App\Services\Stock\Category;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Stock\CategoryRepository as Category;

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
