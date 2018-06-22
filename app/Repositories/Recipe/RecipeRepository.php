<?php

namespace App\Repositories\Recipe;

use Carbon\Carbon;
use App\Repositories\Repository;

class RecipeRepository extends Repository
{
    protected $with = ['products'];

    public function model() {
        return \App\Models\Recipe::class;
    }

    public function initialize()
    {
        return new $this->model();
    }

    // public function create(array $attributes)
    // {
    //     $object = $this->model->create($attributes);
    //
    //     return $object->load($this->with);
    // }
    //
    // public function update(array $attributes, $id)
    // {
    //     if (array_key_exists('id', $attributes)) {
    //         unset($attributes['id']);
    //     }
    //
    //     $object = $this->model->findOrFail($id);
    //     $object->fill($attributes)->save();
    //
    //     $object->load($this->with);
    //
    //     return $object;
    // }

}
