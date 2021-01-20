<?php

namespace App\Domain\Stock\Contracts;

use App\Infrastructure\Contracts\BaseRepositoryInterface;

interface OperationRepositoryInterface extends BaseRepositoryInterface
{
	/**
	 * Count quantity for a product
	 *
	 * @param string $productId
	 * @param integer $count
	 * @return int
	 */
	public function countQuantityByProduct(string $productId, int $count = 0): int;
}