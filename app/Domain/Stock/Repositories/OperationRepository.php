<?php

namespace App\Domain\Stock\Repositories;

use App\Domain\Stock\Entities\Operation;
use App\Infrastructure\Contracts\BaseRepository;
use App\Domain\Stock\Contracts\OperationRepositoryInterface;

class OperationRepository extends BaseRepository implements OperationRepositoryInterface
{
    /**
	 * @inheritDoc
	 */
	public function model(): string
    {
        return Operation::class;
    }

    /**
	 * @inheritDoc
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
     * @inheritDoc
     */
	public function countQuantityByProduct(string $productId): int
    {
        $count = 0;

        $this->model
            ->where('product_id', $productId)
            ->get()
            ->map(function ($item, $key) use (&$count) {
                $count = ($item->operation === Operation::INCREMENT_OPERATOR) ? ($count + $item->quantity) : ($count - $item->quantity);
            });

        return $count;
    }
}
