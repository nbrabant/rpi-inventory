<?php

namespace App\Domain\Stock\Services\Product;

use App\Domain\Stock\Contracts\OperationRepositoryInterface;
use App\Domain\Stock\Contracts\ProductRepositoryInterface;
use App\Domain\Stock\Entities\Dto\OperationData;
use App\Domain\Stock\Entities\Dto\ProductData;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Domain\Stock\Http\Requests\{
    ProductRequest,
    OperationRequest
};

class ProductCommandService
{
    /**
     * @var ProductRepositoryInterface $productRepository
     */
    private ProductRepositoryInterface $productRepository;
    /**
     * @var OperationRepositoryInterface $operationRepository
     */
    private OperationRepositoryInterface $operationRepository;

    /**
     * ProductCommandService constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param OperationRepositoryInterface $operationRepository
     */
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
            ->save(ProductData::fromRequest($request));
    }

    /**
     * @param int $id
     * @param ProductRequest $request
     * @return Model
     */
    public function updateProduct(int $id, ProductRequest $request): Model
    {
        return $this->productRepository
            ->save(ProductData::fromRequest($request), $id);
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
            ->save(OperationData::fromRequest($request));
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
     * @return Model
     */
    public function updateProductStockQuantity(int $id): Model
    {
        return $this->productRepository->update(
            ['quantity' => $this->operationRepository->countQuantityByProduct($id)],
            $id
        );
    }
}
