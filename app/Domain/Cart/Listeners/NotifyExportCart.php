<?php

namespace App\Domain\Cart\Listeners;

use App\Domain\Cart\Entities\Dto\ProductData;
use App\Domain\Cart\Services\CartCommandService;
use App\Infrastructure\Events\ExportCart;

class NotifyExportCart
{
    private CartCommandService $cartCommandService;

    /**
     * @param CartCommandService $cartCommandService
     */
    public function __construct(CartCommandService $cartCommandService)
    {
        $this->cartCommandService = $cartCommandService;
    }

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