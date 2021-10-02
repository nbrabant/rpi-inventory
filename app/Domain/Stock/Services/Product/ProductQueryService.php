<?php

namespace App\Domain\Stock\Services\Product;

use App\Domain\Stock\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductQueryService
{
    /**
     * @var ProductRepositoryInterface $productRepository
     */
    private ProductRepositoryInterface $productRepository;

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
     * @param $id
     * @param Request $request
     * @return Model
     */
    public function getProductRepository($id, Request $request): Model
    {
        return $this->productRepository->find($id, $request);
    }

    /**
     * @param $id
     * @param Request $request
     * @return Model
     */
    public function getProductWithConsumptions($id, Request $request): Model
    {
        $this->productRepository->setWithRelation('operations');

        return $this->productRepository->find($id, $request);
    }

}
