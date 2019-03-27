<?php

namespace App\Domain\Stock\Repositories;

use App\Domain\Stock\Entities\Category;
use App\Interfaces\Repositories\AbstractRepository;

class CategoryRepository extends AbstractRepository
{
    protected $perPage = false;

    public function model()
    {
        return Category::class;
    }

    public function initialize()
    {
        return new $this->model([
            'position' => 255,
        ]);
    }
}
