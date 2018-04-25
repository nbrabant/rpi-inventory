<?php

namespace App\Repositories\Cart;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Repository;
use App\Models\ProductLine;

class CartRepository extends Repository
{
    public function model() {
        return \App\Models\Cart::class;
    }

    public function getCurrentOrCreate(Request $request)
    {
        return $this->model
                    ->with('productLines')
                    ->with('productLines.product')
                    ->firstOrCreate(['finished' => 0]);
    }

    public function getCurrent()
    {
        return $this->model
                    ->with('productLines')
                    ->first();
    }

    public function cartHasProduct($product_id)
    {
        $product = ProductLine::with('cart')
            ->where('product_id', $product_id)
            ->where('cart.finished', 0)
            ->first();

        return (bool)($product && $product instanceof ProductLine);
    }

}
