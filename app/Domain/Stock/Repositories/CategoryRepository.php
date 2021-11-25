<?php

namespace App\Domain\Stock\Repositories;

use App\Domain\Stock\Entities\Category;
use App\Infrastructure\Contracts\BaseRepository;
use App\Domain\Stock\Contracts\CategoryRepositoryInterface;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    /**
     * @var int
     */
    protected int $perPage = 0;

    /**
	 * @inheritDoc
	 */
	public function model(): string
    {
        return Category::class;
    }

    /**
	 * @inheritDoc
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
