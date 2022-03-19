<?php

namespace App\Domain\Schedule\Entities\Dto\NeededProducts;

use App\Domain\Recipe\Entities\RecipeProduct;
use App\Infrastructure\Entities\Dto;

/**
 * @property int $product_id
 * @property int $quantity
 */
class ProductData extends Dto
{
    /**
     * @param RecipeProduct $recipeProduct
     * @return static
     */
    public static function fromRecipeProduct(RecipeProduct $recipeProduct): self {
        return new static([
            'product_id'    => $recipeProduct->product_id,
            'quantity'      => $recipeProduct->quantity,
        ]);
    }
}