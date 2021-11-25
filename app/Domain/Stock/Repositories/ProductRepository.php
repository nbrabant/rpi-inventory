<?php

namespace App\Domain\Stock\Repositories;

use App\Domain\Stock\Entities\Product;
use App\Infrastructure\Contracts\BaseRepository;
use App\Domain\Stock\Contracts\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    /**
	 * @inheritDoc
	 */
	public function model(): string
    {
        return Product::class;
    }

    /**
	 * @inheritDoc
     *
     * @return Product
	 */
    public function initialize(): Product
    {
        return new $this->model([
            'quantity' => 0
        ]);
    }
}
