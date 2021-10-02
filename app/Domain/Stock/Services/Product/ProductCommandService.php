<?php

namespace App\Domain\Stock\Services\Product;

use App\Domain\Stock\Contracts\OperationRepositoryInterface;
use App\Domain\Stock\Contracts\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Validator;

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

    protected $validation = [
        'category_id'	=> 'required|integer',
        'name' 			=> 'required|string|unique:products,name',
        'description'	=> 'required|string',
        'min_quantity'	=> 'required|integer',
        'unit'			=> 'string|in:piece,grammes,litre,sachet',
    ];

    public function __construct(
        ProductRepositoryInterface $productRepository,
        OperationRepositoryInterface $operationRepository
    ) {
        $this->productRepository = $productRepository;
        $this->operationRepository = $operationRepository;
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function initializeProduct(Request $request): Model
    {
        return $this->productRepository->initialize();
    }

    /**
     * @param Request $request
     * @return Model
     */
    public function createProduct(Request $request): Model
    {
        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->productRepository->create($attributes);
    }

    /**
     * @param $id
     * @param Request $request
     * @return Model
     */
    public function updateProduct($id, Request $request): Model
    {
        $this->validation['name'] .= ',' . $id;

        $request->validate($this->validation);

        $attributes = $request->only(array_keys($this->validation));

        return $this->productRepository->update($attributes, $id);
    }

    public function destroyProduct($id)
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
     * @param Request $request
     * @return Model
     */
    public function saveOperation(Request $request): Model
    {
        $request->validate([
            'product_id' => 'required|integer',
            'quantity' => 'required|integer',
            'operation' => 'required|in:+,-',
            'detail' => 'required|string',
        ]);

        $attributes = $request->only([
            'product_id',
            'quantity',
            'operation',
            'detail',
        ]);

        return $this->operationRepository->create($attributes);
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
     * @param $id
     * @return bool
     */
    public function updateProductStockQuantity($id): bool
    {
        $product = $this->productRepository->find($id);
        $product->quantity = $this->operationRepository->countQuantityByProduct($id);

        return $product->save();
    }
}
