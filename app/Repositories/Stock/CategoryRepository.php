<?php

namespace App\Repositories\Stock;

use Carbon\Carbon;
use App\Repositories\Repository;

class CategoryRepository extends Repository
{
    public function model() {
        return \App\Models\Category::class;
    }

    public function initialize()
    {
        return new $this->model([
            'position'      => 255,
        ]);
    }
}
