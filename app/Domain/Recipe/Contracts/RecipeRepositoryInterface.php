<?php

namespace App\Domain\Recipe\Contracts;

use App\Infrastructure\Contracts\BaseRepositoryInterface;

interface RecipeRepositoryInterface extends BaseRepositoryInterface
{
    public function syncProducts(RecipeInterface $recipe, array $products);

    public function syncSteps(RecipeInterface $recipe, array $steps);
}