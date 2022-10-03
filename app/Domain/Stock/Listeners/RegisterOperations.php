<?php

namespace App\Domain\Stock\Listeners;

use App\Domain\Stock\Entities\Dto\ProductData;
use App\Domain\Stock\Services\Product\ProductCommandService;
use Carbon\Carbon;

class RegisterOperations
{
    public function __construct(
        private ProductCommandService $productCommandService
    ) {}

    public function handle($event): void
    {
        ProductData::fromJson($event->getProducts())->each(function (ProductData $productData) {
            $this->productCommandService->createOperation([
                'product_id'    => $productData->product_id,
                'quantity'      => $productData->quantity,
                'operation'     => '+',
                'detail'        => 'Retour de courses du ' . Carbon::now()->format('d/m/Y'),
            ]);
        });
    }
}