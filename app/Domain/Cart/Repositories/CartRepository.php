<?php

namespace App\Domain\Cart\Repositories;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\ProductLineInterface;
use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Entities\Dto\ProductData;
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
    public function cartHasProduct(int $productId): bool
    {
        $product = ProductLine::join('carts', 'carts.id', '=', 'product_lines.cart_id')
            ->where('product_id', $productId)
            ->where('carts.finished', 0)
            ->first();

        return (bool)($product && $product instanceof ProductLine);
    }

    /**
     * @inheritDoc
     */
    public function associateProduct(ProductData $productData): CartInterface
    {
        /** @var CartInterface $cart */
        $cart = $this->getCurrentOrCreate();
        $cart->productLines()->create((array)$productData);

        $cart->load('productLines');

        return $cart;
    }

    /**
     * @inheritDoc
     */
    public function updateProduct(ProductData $productData): CartInterface
    {
        /** @var CartInterface $cart */
        $cart = $this->getCurrentOrCreate();

        $cart->productLines()
            ->where('product_id', $productData->product_id)
            ->first()
            ->fill((array)$productData)
            ->save();

        $cart->load('productLines');

        return $cart;
    }

    /**
     * @inheritDoc
     */
    public function dissociateProduct(ProductData $productData): CartInterface
    {
        /** @var CartInterface $cart */
        $cart = $this->getCurrentOrCreate();

        $cart->productLines()
            ->where('product_id', $productData->product_id)
            ->delete();

        $cart->load('productLines');

        return $cart;
    }

    /**
     * @inheritDoc
     */
    public function purgeCart(): CartInterface
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
    public function addOrUpdateProduct(ProductData $productData): CartInterface
    {
        /** @var CartInterface $cart */
        $cart = $this->getCurrentOrCreate();

        if ($cart->productLines->where('product_id', $productData->product_id)->isEmpty()) {
            $this->associateProduct($productData);
        } else {
            $this->updateProduct($productData);
        }

        $cart->load('productLines');

        return $cart;
    }
}
