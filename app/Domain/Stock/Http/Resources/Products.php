<?php

namespace App\Domain\Stock\Http\Resources;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Stock\Services\Product\ProductCommandService;
use App\Domain\Stock\Services\Product\ProductQueryService;
use App\Domain\Stock\Requests\ProductRequest;

/**
 * @property ProductCommandService productCommandService
 * @property ProductQueryService productQueryService
 */
class Products extends Controller
{
    public function __construct(
        ProductCommandService $productCommandService, 
        ProductQueryService $productQueryService
    ) {
        $this->productCommandService = $productCommandService;
        $this->productQueryService = $productQueryService;
    }

    public function index(Request $request)
    {
        return $this->productQueryService->getProducts($request);
    }

    public function create()
    {
        return $this->productCommandService->initializeProduct($request);
    }

    public function store(ProductRequest $request)
    {
        return $this->productCommandService->createProduct($request);
    }

    public function show(Request $request, $id)
    {
        return $this->productQueryService->getProductRepository($id, $request);
    }

    public function update(ProductRequest $request, $id)
    {
        return $this->productCommandService->updateProduct($id, $request);
    }

    public function destroy($id)
    {
        return $this->productCommandService->destroyProduct($id);
    }
}
