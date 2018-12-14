<?php

namespace App\Repositories\Stock;

use Carbon\Carbon;
use App\Repositories\Repository;

class OperationRepository extends Repository
{
    public function model()
    {
        return \App\Models\Operation::class;
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
