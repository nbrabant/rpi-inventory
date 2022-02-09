<?php

namespace App\Domain\Recipe\Services\Recipe;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Entities\Dto\Recipe\StepData;
use App\Domain\Recipe\Entities\RecipeStep;
use Illuminate\Support\Collection;

class StepCommandService
{
    /**
     * @param RecipeInterface $recipe
     * @param Collection<StepData> $steps
     * @return RecipeInterface
     */
    public function synchronize(RecipeInterface $recipe, Collection $steps): RecipeInterface
    {
        $this->cleanRemoved($recipe, $steps)
            ->updateSteps($recipe, $steps)
            ->addSteps($recipe, $steps);

        return $this->flush($recipe);
    }

    /**
     * @param RecipeInterface $recipe
     * @param Collection<StepData> $steps
     * @return $this
     */
    private function cleanRemoved(RecipeInterface $recipe, Collection $steps): self
    {
        $recipe->steps->map(function (RecipeStep $recipeStep) use ($steps) {
            $count = $steps->countBy(function (StepData $step) use ($recipeStep) {
                return $step->id === $recipeStep->id;
            });

            if (!$count) {
                $recipeStep->delete();
            }

            return true;
        });

        return $this;
    }

    /**
     * @param RecipeInterface $recipe
     * @param Collection<StepData> $steps
     * @return $this
     */
    private function updateSteps(RecipeInterface $recipe, Collection $steps): self
    {
        $recipe->steps->map(function (RecipeStep $recipeStep) use ($steps) {
            $recipeStep->fill(
                (array)$steps->firstWhere('id', $recipeStep->id)
            )->save();
        });

        return $this;
    }

    /**
     * @param RecipeInterface $recipe
     * @param Collection<StepData> $steps
     * @return $this
     */
    private function addSteps(RecipeInterface $recipe, Collection $steps): self
    {
        $filtered = $steps->filter(function (StepData $step) use ($recipe) {
            return null === $recipe->steps->firstWhere('id', $step->id);
        });

        $filtered->each(function (StepData $step) use($recipe) {
            $recipe->products()->save((array)$step);
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