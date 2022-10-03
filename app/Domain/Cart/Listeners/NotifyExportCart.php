<?php

namespace App\Domain\Cart\Listeners;

use App\Domain\Cart\Entities\Dto\ProductData;
use App\Domain\Cart\Services\CartCommandService;
use App\Domain\Schedule\Events\ExportCart;

class NotifyExportCart
{
    public function __construct(
        private CartCommandService $cartCommandService
    ) {}

    /**
     * @param ExportCart $exportCart
     * @return void
     */
    public function handle(ExportCart $exportCart): void
    {
        $this->cartCommandService->addProducts(
            ProductData::fromJson($exportCart->getProducts())
        );
    }
}