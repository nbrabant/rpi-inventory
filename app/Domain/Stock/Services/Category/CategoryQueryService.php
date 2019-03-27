<?php

namespace App\Domain\Stock\Services\Category;

use Illuminate\Http\Request;
use App\Domain\Stock\Repositories\CategoryRepository as Category;

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
