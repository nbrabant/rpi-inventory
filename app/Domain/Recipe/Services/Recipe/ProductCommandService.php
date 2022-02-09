<?php

namespace App\Domain\Recipe\Services\Recipe;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Entities\Dto\Recipe\ProductData;
use App\Domain\Recipe\Entities\RecipeProduct;
use Illuminate\Support\Collection;

class ProductCommandService
{
    /**
     * @param RecipeInterface $recipe
     * @param Collection<ProductData> $products
     * @return RecipeInterface
     */
    public function synchronize(RecipeInterface $recipe, Collection $products): RecipeInterface
    {
        $this->cleanRemoved($recipe, $products)
            ->updateProducts($recipe, $products)
            ->addProducts($recipe, $products);

        return $this->flush($recipe);
    }

    /**
     * @param RecipeInterface $recipe
     * @param Collection<ProductData> $products
     * @return $this
     */
    private function cleanRemoved(RecipeInterface $recipe, Collection $products): self
    {
        $recipe->products->map(function (RecipeProduct $recipeProduct) use ($products) {
            $count = $products->countBy(function (ProductData $product) use ($recipeProduct) {
                return $product->product_id === $recipeProduct->product_id;
            });

            if (!$count) {
                $recipeProduct->delete();
            }

            return true;
        });

        return $this;
    }

    /**
     * @param RecipeInterface $recipe
     * @param Collection<ProductData> $products
     * @return $this
     */
    private function updateProducts(RecipeInterface $recipe, Collection $products): self
    {
        $recipe->products->map(function (RecipeProduct $recipeProduct) use ($products) {
            $recipeProduct->fill(
                (array)$products->firstWhere('product_id', $recipeProduct->product_id)
            )->save();
        });

        return $this;
    }

    /**
     * @param RecipeInterface $recipe
     * @param Collection<ProductData> $products
     * @return $this
     */
    private function addProducts(RecipeInterface $recipe, Collection $products): self
    {
        $filtered = $products->filter(function (ProductData $product) use ($recipe) {
            return null === $recipe->products->firstWhere('product_id', $product->product_id);
        });

        $filtered->each(function (ProductData $product) use($recipe) {
            $recipe->products()->save((array)$product);
        });

        return $this;
    }

    /**
     * @param RecipeInterface $recipe
     * @return RecipeInterface
     */
    private function flush(RecipeInterface $recipe): RecipeInterface
    {
        return $recipe->load(['products', 'steps']);
    }
}