<?php

namespace App\Domain\Recipe\Entities\Dto;

use App\Domain\Recipe\Entities\Dto\Recipe\ProductData;
use App\Domain\Recipe\Entities\Dto\Recipe\StepData;
use App\Domain\Recipe\Http\Requests\RecipeRequest;
use App\Infrastructure\Entities\Dto;
use Illuminate\Support\Collection;

/**
 * @property Collection<ProductData> products
 * @property Collection<StepData> steps
 */
class RecipeData extends Dto
{
    /**
     * @param RecipeRequest $request
     * @return static
     */
    public static function fromRequest(RecipeRequest $request): self
    {
        return new static([
            'name'              => $request->getName(),
            'recipe_type'       => $request->getRecipeType(),
            'number_people'     => $request->getNumberPeople(),
            'preparation_time'  => $request->getPreparationTime(),
            'cooking_time'      => $request->getCookingTime(),
            'complement'        => $request->getComplement(),
            'products'          => collect(array_map(function (array $product) {
                return ProductData::fromAttribute($product);
            }, $request->getProducts())),
            'steps'             => collect(array_map(function (array $step) {
                return StepData::fromAttribute($step);
            }, $request->getSteps())),
        ]);
    }
}