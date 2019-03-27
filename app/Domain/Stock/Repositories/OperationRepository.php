<?php

namespace App\Domain\Stock\Repositories;

use App\Domain\Stock\Entities\Operation;
use App\Interfaces\Repositories\AbstractRepository;

class OperationRepository extends AbstractRepository
{
    public function model()
    {
        return Operation::class;
    }

    public function initialize()
    {
        return new $this->model([
            'detail' => ''
        ]);
    }

    public function countQuantityByProduct($productId, $count = 0)
    {
        $this->model
            ->where('product_id', $productId)
            ->get()
            ->map(function ($item, $key) use (&$count) {
                $count = ($item->operation === '+') ? ($count + $item->quantity) : ($count - $item->quantity);
            });

        return $count;
    }
}
