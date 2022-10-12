<?php

namespace App\Domain\Stock\Listeners;

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

    public function handle($event): void
    {
        $this->productCommandService->updateProductStockQuantity(
            $event->getOperation()->product_id
        );
    }
}