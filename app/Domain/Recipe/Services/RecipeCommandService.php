<?php

namespace App\Domain\Recipe\Services;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Entities\Dto\RecipeData;
use App\Domain\Recipe\Services\Recipe\ProductCommandService;
use App\Domain\Recipe\Services\Recipe\StepCommandService;
use Illuminate\Database\Eloquent\Model;
use App\Domain\Recipe\Contracts\RecipeRepositoryInterface;
use App\Domain\Recipe\Http\Requests\RecipeRequest;

class RecipeCommandService
{
    /**
     * @var RecipeRepositoryInterface $recipeRepository
     */
    private RecipeRepositoryInterface $recipeRepository;
    /**
     * @var ProductCommandService $productCommandService
     */
    private ProductCommandService $productCommandService;
    /**
     * @var StepCommandService $stepCommandService
     */
    private StepCommandService $stepCommandService;

    /**
     * Create Cart Recipe Service instance.
     *
     * @param RecipeRepositoryInterface $recipeRepository
     * @param ProductCommandService $productCommandService
     * @param StepCommandService $stepCommandService
     */
    public function __construct(
        RecipeRepositoryInterface $recipeRepository,
        ProductCommandService $productCommandService,
        StepCommandService $stepCommandService
    ) {
        $this->recipeRepository = $recipeRepository;
        $this->productCommandService = $productCommandService;
        $this->stepCommandService = $stepCommandService;
    }

    /**
     * @return Model
     */
    public function initializeRecipe(): Model
    {
        return $this->recipeRepository->initialize();
    }

    /**
     * @param RecipeRequest $request
     * @return RecipeInterface
     */
    public function createRecipe(RecipeRequest $request): RecipeInterface
    {
        $recipeData = RecipeData::fromRequest($request);

        $recipe = $this->recipeRepository->save($recipeData);
        $recipe = $this->productCommandService->synchronize($recipe, $recipeData->products);
        $recipe = $this->stepCommandService->synchronize($recipe, $recipeData->steps);

        return $recipe;
    }

    /**
     * @param int $id
     * @param RecipeRequest $request
     * @return RecipeInterface
     */
    public function updateRecipe(int $id, RecipeRequest $request): RecipeInterface
    {
        $recipeData = RecipeData::fromRequest($request);

        $recipe = $this->recipeRepository->save($recipeData, $id);
        $recipe = $this->productCommandService->synchronize($recipe, $recipeData->products);
        $recipe = $this->stepCommandService->synchronize($recipe, $recipeData->steps);

        // if ($request->file('image') && $request->file('image')->isValid()) {
        //     $imageName = str_slug_fr($recipe->name).'-'.$recipe->id.'.'.$request->file('image')->getClientOriginalExtension();
        //
        //     $request->file('image')->move(
        //         base_path().'/public/brands', $imageName
        //     );
        //
        //     $recipe->visual = $request->file('image')->getClientOriginalExtension();
        //     $recipe->save();
        // }

        return $recipe;
    }

    /**
     * @param int $id
     * @return int
     */
    public function destroyRecipe(int $id): int
    {
        return $this->recipeRepository->destroy($id);
    }
}
