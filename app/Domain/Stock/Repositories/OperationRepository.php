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

        /**
         * @TODO validate if count is not negative
         * currently it is possible that the $count is a signed int (negative e.g."-5") when the user wants to "retrait" products.
         * As the quantity field in the database is unsigned, mysql will not do the following update and exit with:
         * SQLSTATE[22003]: Numeric value out of range: 1264 Out of range value for column 'quantity' at row 1 (SQL: update `products` set `quantity` = -3
         */
        return $count;
    }
}
