<?php

namespace App\Domain\Schedule\Contracts;

use App\Infrastructure\Contracts\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

interface ScheduleRepositoryInterface extends BaseRepositoryInterface
{
	/**
	 * Retrieve all recipe from Context
	 *
	 * @param Request $request
	 * @return Collection
	 */
	public function getAllRecipes(Request $request): Collection;
}