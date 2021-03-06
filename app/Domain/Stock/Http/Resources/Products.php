<?php

namespace App\Domain\Stock\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Stock\Services\Product\ProductCommandService;
use App\Domain\Stock\Services\Product\ProductQueryService;
use App\Domain\Stock\Http\Requests\ProductRequest;
use Illuminate\Pagination\LengthAwarePaginator;

class Products extends Controller
{
    /**
     * @var ProductCommandService $productCommandService
     */
    private ProductCommandService $productCommandService;
    /**
     * @var ProductQueryService $productQueryService
     */
    private ProductQueryService $productQueryService;

    /**
     * @param ProductCommandService $productCommandService
     * @param ProductQueryService $productQueryService
     */
    public function __construct(
        ProductCommandService $productCommandService, 
        ProductQueryService $productQueryService
    ) {
        $this->productCommandService = $productCommandService;
        $this->productQueryService = $productQueryService;
    }

    /**
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public function index(Request $request): LengthAwarePaginator
    {
        return $this->productQueryService->getProducts($request);
    }

    /**
     * @return Model
     */
    public function create(): Model
    {
        return $this->productCommandService->initializeProduct();
    }

    /**
     * @param ProductRequest $request
     * @return Model
     */
    public function store(ProductRequest $request): Model
    {
        return $this->productCommandService->createProduct($request);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Model
     */
    public function show(Request $request, string $id): Model
    {
        return $this->productQueryService->getProductRepository($id, $request);
    }

    /**
     * @param ProductRequest $request
     * @param int $id
     * @return Model
     */
    public function update(ProductRequest $request, int $id): Model
    {
        return $this->productCommandService->updateProduct($id, $request);
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroy(int $id): int
    {
        return $this->productCommandService->destroyProduct($id);
    }
}
