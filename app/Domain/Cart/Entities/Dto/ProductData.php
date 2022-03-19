<?php

namespace App\Domain\Cart\Entities\Dto;

use App\Domain\Cart\Http\Requests\CartProductRequestInterface;
use App\Infrastructure\Entities\Dto;
use Illuminate\Support\Collection;

/**
 * @property int product_id
 * @property int quantity
 */
class ProductData extends Dto
{
    public static function fromRequest(CartProductRequestInterface $request): self
    {
        return new static([
            'product_id'    => $request->getProductId(),
            'quantity'      => $request->getQuantity(),
        ]);
    }

    /**
     * @param string $productsDatas
     * @return Collection<ProductData>
     */
    public static function fromJson(string $productsDatas): Collection
    {
        return collect(json_decode($productsDatas))->map(function ($productData) {
            return new static([
                'product_id'    => $productData->product_id,
                'quantity'      => $productData->quantity,
            ]);
        });
    }
}