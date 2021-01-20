<?php

namespace App\Domain\Stock\Repositories;

use App\Domain\Stock\Entities\Operation;
use App\Infrastructure\Contracts\BaseRepository;
use App\Domain\Stock\Contracts\OperationRepositoryInterface;

class OperationRepository extends BaseRepository implements OperationRepositoryInterface
{
    /**
	 * Return repository entity model used
	 *
	 * @return string
	 */
	public function model(): string
    {
        return Operation::class;
    }

    /**
	 * Initialize new Eloquent model
	 *
	 * @return Operation
	 */
    public function initialize(): Operation
    {
        return new $this->model([
            'detail' => ''
        ]);
    }

    /**
	 * Count quantity for a product
	 *
	 * @param string $productId
	 * @param integer $count
	 * @return int
	 */
	public function countQuantityByProduct(string $productId, int $count = 0): int
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
