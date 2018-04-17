<?php

namespace App\Repositories\Cart;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Repository;

class CartRepository extends Repository
{
    public function model() {
        return \App\Models\Cart::class;
    }

    public function getCurrentOrCreate(Request $request)
    {
        return $this->model->with('productLines')->firstOrCreate(['finished' => 0]);
    }


}
