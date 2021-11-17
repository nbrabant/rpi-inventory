<?php

namespace App\Domain\Cart\Repositories;

use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Entities\ProductLine;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Infrastructure\Contracts\BaseRepository;
use App\Domain\Cart\Contracts\CartRepositoryInterface;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    /**
     * Return repository entity model used
     *
     * @return string
     */
    public function model(): string
    {
        return Cart::class;
    }
    
    /**
	 * Initialize new Eloquent model
	 *
	 * @return Cart
	 */
    public function initialize(): Cart
    {
        return new $this->model([
            'date_creation' => Carbon::now(),
        ]);
    }

    /**
     * Create if it need and return current active cart
     *
     * @return Cart
     */
    public function getCurrentOrCreate(): Cart
    {
        return $this->model
                    ->with('productLines')
                    ->with('productLines.product')
                    ->firstOrCreate(['finished' => 0]);
    }

    /**
     * Retrieve current active cart
     *
     * @return Cart
     */
    public function getCurrent(): Cart
    {
        return $this->model
                    ->with('productLines')
                    ->first();
    }

    /**
     * Fill current active cart with attributes and return it
     *
     * @param Request $request
     * @param array $attributes
     * @return Cart
     */
    public function updateCurrent(Request $request, $attributes): Cart
    {
        $cart = $this->getCurrentOrCreate();

        $cart->fill($attributes);

        $cart->save();

        return $this->getCurrentOrCreate();
    }

    /**
     * Determine if current active cart has the specified product
     *
     * @param int $product_id
     * @return bool
     */
    public function cartHasProduct($product_id): bool
    {
        $product = ProductLine::join('carts', 'carts.id', '=', 'product_lines.cart_id')
            ->where('product_id', $product_id)
            ->where('carts.finished', 0)
            ->first();

        return (bool)($product && $product instanceof ProductLine);
    }

    /**
     * Associate product to current active cart
     *
     * @param Request $request
     * @param [type] $attributes
     * @return Cart
     */
    public function associateProduct(Request $request, $attributes): Cart
    {
        $cart = $this->getCurrentOrCreate();
        $cart->productLines()->create($attributes);

        $cart->load('productLines');

        return $cart;
    }

    /**
     * Update cart's product information
     *
     * @param Request $request
     * @param [type] $attributes
     * @param int $product_id
     * @return Cart
     */
    public function updateProduct(Request $request, $attributes, $product_id): Cart
    {
        $cart = $this->getCurrentOrCreate();

        $productLine = $cart->productLines()->where('product_id', $product_id)->first();
        $productLine->fill($attributes);
        $productLine->save();

        $cart->load('productLines');

        return $cart;
    }

    /**
     * Dissociate product to current cart
     *
     * @param Request $request
     * @param int $product_id
     * @return Cart
     */
    public function dissociateProduct(Request $request, $product_id): Cart
    {
        $cart = $this->getCurrentOrCreate();

        $productLine = $cart->productLines()->where('product_id', $product_id)->delete();

        $cart->load('productLines');

        return $cart;
    }

    /**
     * Remove all the products of current cart
     *
     * @return Cart
     */
    public function purgeCart(Request $request): Cart
    {
        $cart = $this->getCurrentOrCreate();

        $cart->productLines->map(function ($productLine) {
            $productLine->delete();
        });

        return $cart;
    }

    /**
     * Synchronize product added to cart
     *
     * @param Request $request
     * @param [type] $recipeProducts
     * @return Cart
     */
    public function addOrUpdateProducts(Request $request, $recipeProducts): Cart
    {
        $cart = $this->getCurrentOrCreate();

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
