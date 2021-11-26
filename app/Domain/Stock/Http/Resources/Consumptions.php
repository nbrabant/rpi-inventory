<?php

namespace App\Domain\Stock\Http\Resources;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Stock\Services\Product\ProductCommandService;
use App\Domain\Stock\Services\Product\ProductQueryService;
use App\Domain\Stock\Requests\OperationRequest;

/**
 * @property ProductCommandService productCommandService
 * @property ProductQueryService productQueryService
 */
class Consumptions extends Controller
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
     * @return mixed[]
     */
    public function index(Request $request): array
    {
        return [];
    }

    /**
     * @return Model
     */
    public function create(): Model
    {
        return $this->productCommandService->initializeOperation();
    }

    /**
     * @param OperationRequest $request
     * @return Model
     */
    public function store(OperationRequest $request): Model
    {
        return $this->productCommandService->saveOperation($request);
    }

    /**
     * @param Request $request
     * @param string $id
     * @return Model
     */
    public function show(Request $request, string $id): Model
    {
        return $this->productQueryService->getProductWithConsumptions($id, $request);
    }
}
