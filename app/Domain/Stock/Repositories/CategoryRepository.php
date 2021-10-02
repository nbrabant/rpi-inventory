<?php

namespace App\Domain\Stock\Repositories;

use App\Domain\Stock\Entities\Category;
use App\Infrastructure\Contracts\BaseRepository;
use App\Domain\Stock\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    protected $perPage = false;

    /**
	 * Return repository entity model used
	 *
	 * @return string
	 */
	public function model(): string
    {
        return Category::class;
    }

    /**
	 * Initialize new Eloquent model
	 *
	 * @return Category
	 */
    public function initialize(): Category
    {
        return new $this->model([
            'position' => 255,
        ]);
    }
}
