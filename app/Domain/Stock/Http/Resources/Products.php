<?php

namespace App\Domain\Stock\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Stock\Services\Product\ProductCommandService;
use App\Domain\Stock\Services\Product\ProductQueryService;
use App\Domain\Stock\Requests\ProductRequest;
use Illuminate\Pagination\LengthAwarePaginator;

/**
 * @property ProductCommandService productCommandService
 * @property ProductQueryService productQueryService
 */
class Products extends Controller
{
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
     * @param int $id
     * @return Model
     */
    public function show(Request $request, int $id): Model
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
