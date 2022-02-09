<?php

namespace App\Domain\Cart\Entities\Dto;

use App\Domain\Cart\Http\Requests\CartProductRequestInterface;
use App\Infrastructure\Entities\Dto;

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
}