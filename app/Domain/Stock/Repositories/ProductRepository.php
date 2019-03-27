<?php

namespace App\Domain\Stock\Repositories;

use App\Domain\Stock\Entities\Product;
use App\Interfaces\Repositories\AbstractRepository;

class ProductRepository extends AbstractRepository
{
    public function model()
    {
        return Product::class;
    }

    public function initialize()
    {
        return new $this->model([
            'quantity' => 0
        ]);
    }
}
