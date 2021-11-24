<?php

namespace App\Domain\Cart\Repositories;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\ProductLineInterface;
use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Entities\ProductLine;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Infrastructure\Contracts\BaseRepository;
use App\Domain\Cart\Contracts\CartRepositoryInterface;

class CartRepository extends BaseRepository implements CartRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function model(): string
    {
        return Cart::class;
    }
    
    /**
	 * @inheritDoc
	 */
    public function initialize(): Cart
    {
        return new $this->model([
            'date_creation' => Carbon::now(),
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getCurrentOrCreate(): CartInterface
    {
        return $this->model
                    ->with('productLines')
                    ->with('productLines.product')
                    ->firstOrCreate(['finished' => 0]);
    }

    /**
     * @inheritDoc
     */
    public function getCurrent(): CartInterface
    {
        return $this->model
                    ->with('productLines')
                    ->first();
    }

    /**
     * @inheritDoc
     */
    public function updateCurrent(Request $request, array $attributes): CartInterface
    {
        $this->getCurrentOrCreate()
            ->fill($attributes)
            ->save();

        return $this->getCurrentOrCreate();
    }

    /**
     * @inheritDoc
     */
    public function cartHasProduct(int $product_id): bool
    {
        $product = ProductLine::join('carts', 'carts.id', '=', 'product_lines.cart_id')
            ->where('product_id', $product_id)
            ->where('carts.finished', 0)
            ->first();

        return (bool)($product && $product instanceof ProductLine);
    }

    /**
     * @inheritDoc
     */
    public function associateProduct(Request $request, array $attributes): CartInterface
    {
        /** @var CartInterface $cart */
        $cart = $this->getCurrentOrCreate();
        $cart->productLines()->create($attributes);

        $cart->load('productLines');

        return $cart;
    }

    /**
     * @inheritDoc
     */
    public function updateProduct(Request $request, array $attributes, int $product_id): CartInterface
    {
        /** @var CartInterface $cart */
        $cart = $this->getCurrentOrCreate();

        /** @var ProductLineInterface $productLine */
        $productLine = $cart->productLines()->where('product_id', $product_id)->first();
        $productLine->fill($attributes);
        $productLine->save();

        $cart->load('productLines');

        return $cart;
    }

    /**
     * @inheritDoc
     */
    public function dissociateProduct(Request $request, $product_id): CartInterface
    {
        /** @var CartInterface $cart */
        $cart = $this->getCurrentOrCreate();

        $cart->productLines()->where('product_id', $product_id)->delete();

        $cart->load('productLines');

        return $cart;
    }

    /**
     * @inheritDoc
     */
    public function purgeCart(Request $request): CartInterface
    {
        /** @var CartInterface $cart */
        $cart = $this->getCurrentOrCreate();

        $cart->productLines->map(function ($productLine) {
            $productLine->delete();
        });

        return $cart;
    }

    /**
     * @inheritDoc
     */
    public function addOrUpdateProducts(Request $request, $recipeProducts): CartInterface
    {
        /** @var CartInterface $cart */
        $cart = $this->getCurrentOrCreate();

        /**
         * @TODO : recipe product should provide from another domain
         */
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
