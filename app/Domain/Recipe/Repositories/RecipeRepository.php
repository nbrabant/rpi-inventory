<?php

namespace App\Domain\Recipe\Repositories;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Entities\Dto\RecipeData;
use App\Domain\Recipe\Entities\RecipeProduct;
use App\Domain\Recipe\Entities\RecipeStep;
use App\Infrastructure\Contracts\BaseRepository;
use App\Domain\Recipe\Entities\Recipe as Recipe;
use \App\Helpers\ParseHelper;
use App\Domain\Recipe\Contracts\RecipeRepositoryInterface;
use App\Infrastructure\Entities\Dto;
use Illuminate\Database\Eloquent\Model;

class RecipeRepository extends BaseRepository implements RecipeRepositoryInterface
{
    /**
     * @var string[]
     */
    protected array $with = ['products', 'steps'];

    /**
	 * @inheritDoc
	 *
	 * @return string
	 */
	public function model(): string
    {
        return Recipe::class;
    }

    /**
     * @inheritDoc
     *
     * @return Recipe
     */
    public function initialize(): Recipe
    {
        return new $this->model();
    }
}
