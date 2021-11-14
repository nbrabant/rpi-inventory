<?php

namespace App\Domain\Stock\Http\Resources;

use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Stock\Services\Product\ProductCommandService;
use App\Domain\Stock\Services\Product\ProductQueryService;

/**
 * @property ProductCommandService productCommandService
 * @property ProductQueryService productQueryService
 */
class Consumptions extends Controller
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
        return [];
    }

    public function create(Request $request)
    {
        return $this->productCommandService->initializeOperation($request);
    }

    public function store(Request $request)
    {
        return $this->productCommandService->saveOperation($request);
    }

    public function show(Request $request, $id)
    {
        return $this->productQueryService->getProductWithConsumptions($id, $request);
    }
}
