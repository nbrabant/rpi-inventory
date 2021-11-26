<?php

namespace App\Domain\Stock\Services\Product;

use App\Domain\Stock\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property ProductRepositoryInterface $productRepository
 */
class ProductQueryService
{
    /**
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(
        ProductRepositoryInterface $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function getProducts(Request $request): LengthAwarePaginator
    {
        return $this->productRepository->getAll($request);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Model
     */
    public function getProductRepository(string $id, Request $request): Model
    {
        return $this->productRepository->find($id, $request);
    }

    /**
     * @param string $id
     * @param Request $request
     * @return Model
     */
    public function getProductWithConsumptions(string $id, Request $request): Model
    {
        $this->productRepository->setWithRelation('operations');

        return $this->productRepository->find($id, $request);
    }

}
