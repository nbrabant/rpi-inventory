<?php

namespace App\Domain\Stock\Listeners;

use App\Domain\Stock\Entities\Operation;
use App\Domain\Stock\Services\Product\ProductCommandService;

class UpdateStockQuantity
{
    /**
     * @var ProductCommandService $productCommandService
     */
    private ProductCommandService $productCommandService;

    /**
     * @param ProductCommandService $productCommandService
     */
    public function __construct(ProductCommandService $productCommandService)
    {
        $this->productCommandService = $productCommandService;
    }

    public function handle(Operation $operation): void
    {
        $this->productCommandService->updateProductStockQuantity($operation->product_id);
    }
}