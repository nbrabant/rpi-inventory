<?php

namespace App\Repositories\Stock;

use Carbon\Carbon;
use App\Repositories\Repository;

class ProductRepository extends Repository
{
    public function model() {
        return \App\Models\Product::class;
    }

    public function initialize()
    {
        return new $this->model([
            'quantite' => 0
        ]);
    }
}
