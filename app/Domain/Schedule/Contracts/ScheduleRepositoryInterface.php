<?php

namespace App\Domain\Schedule\Contracts;

use App\Infrastructure\Contracts\BaseRepositoryInterface;
use Illuminate\Http\Request;

interface ScheduleRepositoryInterface extends BaseRepositoryInterface
{
	/**
	 * Retrieve all recipe from Context
	 *
	 * @param Request $request
	 * @return void
	 */
	public function getAllRecipes(Request $request);
}