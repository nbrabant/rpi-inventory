<?php

namespace App\Domain\Schedule\Entities\Dto;

use App\Domain\Recipe\Entities\RecipeProduct;
use App\Domain\Schedule\Entities\Dto\NeededProducts\ProductData;
use App\Infrastructure\Entities\Dto;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Support\Collection;


/**
 * @property Collection<ProductData> $products
 */
class NeededProductsData extends Dto
{
    /**
     * @param EloquentCollection $recipeProducts
     * @return $this
     */
    public function addProducts(EloquentCollection $recipeProducts): NeededProductsData
    {
        $recipeProducts->map(function (RecipeProduct $recipeProduct) {
            $this->addProduct(ProductData::fromRecipeProduct($recipeProduct));
        });

        return $this;
    }

    /**
     * @return string
     */
    public function toJson(): string
    {
        return $this->products->toJson();
    }

    /**
     * @param ProductData $productData
     * @return $this
     */
    public function addProduct(ProductData $productData): self
    {
        $productData = $this->retrieveFromProduct($productData);

        $this->products->put($productData->product_id, $productData);

        return $this;
    }

    /**
     * @param ProductData $productData
     * @return void
     */
    private function retrieveFromProduct(ProductData $productData): ProductData
    {
        $currentProductData = $this->products
            ->where('product_id', $productData->product_id)
            ->first();

        if ($currentProductData) {
            $this->products->forget($productData->product_id);
            $productData->quantity += $currentProductData->quantity;
        }

        return $productData;
    }

}