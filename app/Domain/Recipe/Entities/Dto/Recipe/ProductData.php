<?php

namespace App\Domain\Recipe\Entities\Dto\Recipe;

use App\Infrastructure\Entities\Dto;

/**
 * @property int product_id
 * @property int quantity
 * @property string unit
 */
class ProductData extends Dto
{
    /**
     * @param mixed[] $product
     * @return self
     */
    public static function fromAttribute(array $product): self
    {
        return new static([
            'product_id'    => $product['product_id'],
            'quantity'      => $product['quantity'],
            'unit'          => $product['unit'],
        ]);
    }
}