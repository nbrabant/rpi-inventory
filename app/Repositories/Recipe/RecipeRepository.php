<?php

namespace App\Repositories\Recipe;

use Carbon\Carbon;
use App\Repositories\Repository;

class RecipeRepository extends Repository
{
    public function model() {
        return \App\Models\Recipe::class;
    }

    public function initialize()
    {
        return new $this->model();
    }
}
