<?php

namespace App\Domain\Stock\Services\Product;

use App\Domain\Stock\Contracts\OperationRepositoryInterface;
use App\Domain\Stock\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Domain\Stock\Http\Requests\{
    ProductRequest,
    OperationRequest
};

/**
 * @property ProductRepositoryInterface $productRepository
 * @property OperationRepositoryInterface $operationRepository
 */
class ProductCommandService
{
    public function __construct(
        ProductRepositoryInterface $productRepository,
        OperationRepositoryInterface $operationRepository
    ) {
        $this->productRepository = $productRepository;
        $this->operationRepository = $operationRepository;
    }

    /**
     * @return Model
     */
    public function initializeProduct(): Model
    {
        return $this->productRepository->initialize();
    }

    /**
     * @param ProductRequest $request
     * @return Model
     */
    public function createProduct(ProductRequest $request): Model
    {
        return $this->productRepository
            ->create($request->validated());
    }

    /**
     * @param int $id
     * @param ProductRequest $request
     * @return Model
     */
    public function updateProduct(int $id, ProductRequest $request): Model
    {
        return $this->productRepository
            ->update($request->validated(), $id);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroyProduct(int $id): int
    {
        return $this->productRepository->destroy($id);
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function initializeOperation(Request $request): Model
    {
        $request->validate(['product_id' => 'required|integer']);

        $operation = $this->operationRepository->initialize();

        $operation->fill($request->only('product_id'));

        return $operation;
    }

    /**
     * @param OperationRequest $request
     * @return Model
     */
    public function saveOperation(OperationRequest $request): Model
    {
        return $this->operationRepository
            ->create($request->validated());
    }

    /**
     * @param $attributes
     * @return Model
     */
    public function createOperation($attributes): Model
    {
        return $this->operationRepository->create($attributes);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function updateProductStockQuantity(int $id): bool
    {
        $product = $this->productRepository->find($id);
        $product->quantity = $this->operationRepository->countQuantityByProduct($id);

        return $product->save();
    }
}
