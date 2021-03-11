<?php

namespace App\Domain\Stock\Contracts;

use App\Infrastructure\Contracts\BaseRepositoryInterface;

interface OperationRepositoryInterface extends BaseRepositoryInterface
{
	/**
	 * Count quantity for a product
	 *
	 * @param string $productId
	 * @return int
	 */
	public function countQuantityByProduct(string $productId): int;
}