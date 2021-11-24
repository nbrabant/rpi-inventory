<?php

namespace App\Domain\Recipe\Contracts;

use App\Infrastructure\Contracts\BaseRepositoryInterface;

interface RecipeRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * @param RecipeInterface $recipe
     * @param mixed[] $productsList
     * @return RecipeInterface
     */
    public function syncProducts(RecipeInterface $recipe, array $productsList): RecipeInterface;

    /**
     * @param RecipeInterface $recipe
     * @param mixed[] $stepsList
     * @return RecipeInterface
     */
    public function syncSteps(RecipeInterface $recipe, array $stepsList): RecipeInterface;
}