<?php

namespace App\Repositories\Cart;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Repositories\Repository;
use App\Models\ProductLine;

class CartRepository extends Repository
{
    public function model()
    {
        return \App\Models\Cart::class;
    }
    
    public function initialize()
    {
        return new $this->model([
            'date_creation' => Carbon::now(),
        ]);
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

    public function updateCurrent(Request $request, $attributes)
    {
        $cart = $this->getCurrentOrCreate($request);

        $cart->fill($attributes);

        $cart->save();

        return $this->getCurrentOrCreate($request);
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

        $cart->load('productLines');

        return $cart;
    }

    public function updateProduct(Request $request, $attributes, $product_id)
    {
        $cart = $this->getCurrentOrCreate($request);

        $productLine = $cart->productLines()->where('product_id', $product_id)->first();
        $productLine->fill($attributes);
        $productLine->save();

        $cart->load('productLines');

        return $cart;
    }

    public function dissociateProduct(Request $request, $product_id)
    {
        $cart = $this->getCurrentOrCreate($request);

        $productLine = $cart->productLines()->where('product_id', $product_id)->delete();

        $cart->load('productLines');

        return $cart;
    }

    public function purgeCart(Request $request)
    {
        $cart = $this->getCurrentOrCreate($request);

        $cart->productLines->map(function ($productLine) {
            $productLine->delete();
        });

        return $cart;
    }

    public function addOrUpdateProducts(Request $request, $recipeProducts)
    {
        $cart = $this->getCurrentOrCreate($request);

        $recipeProducts->map(function ($recipeProduct) use ($request, $cart) {
            if ($cart->productLines->where('product_id', $recipeProduct->product_id)->isEmpty()) {
                $this->associateProduct($request, [
                    'product_id' => $recipeProduct->product_id,
                    'quantity' => $recipeProduct->quantity,
                    'unit' => $recipeProduct->unit,
                ]);
            } else {
                $this->updateProduct($request, [
                    'quantity' => $recipeProduct->quantity,
                ], $recipeProduct->product_id);
            }
        });

        $cart->load('productLines');

        return $cart;
    }
}
