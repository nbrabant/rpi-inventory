<?php

namespace App\Repositories;

use Carbon\Carbon;

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
