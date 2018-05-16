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
        $product = ProductLine::join('carts', 'carts.id', '=', 'product_lines.cart_id')
            ->where('product_id', $product_id)
            ->where('carts.finished', 0)
            ->first();

        return (bool)($product && $product instanceof ProductLine);
    }

    public function associateProduct(Request $request, $attributes)
    {
        $cart = $this->getCurrentOrCreate($request);
        $cart->productLines()->create($attributes);

        return $cart;
    }

    public function dissociateProduct(Request $request, $product_id)
    {
        $cart = $this->getCurrentOrCreate($request);

        $productLine = $cart->productLines()->where('product_id', $product_id)->delete();

        return $cart;
    }

}
