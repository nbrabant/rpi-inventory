<?php

namespace App\Services\Cart;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Cart\CartRepository as Cart;
use Validator;
use App\Rules\NotInCart;
use App\Rules\IsInCart;

class CartCommandService
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function updateCart(Request $request)
    {
        $request->validate([
            'finished' => 'boolean'
        ]);

        $attributes = $request->only(['finished']);

        return $this->cart->updateCurrent($request, $attributes);
    }

    public function updateTrelloCard(Request $request, $trelloCardId)
    {
        return $this->cart->updateCurrent($request, ['trello_card_id' => $trelloCardId]);
    }

    // add product
    public function attachProduct(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', new NotInCart],
            'quantity' => 'required|integer'
        ]);

        $attributes = $request->only(['product_id', 'quantity']);

        return $this->cart->associateProduct($request, $attributes);
    }

    // update product
    public function updateProduct(Request $request, $cart_id)
    {
        $request->validate([
            'product_id' => ['required', 'integer', new IsInCart],
            'quantity' => 'required|integer'
        ]);

        $attributes = $request->only(['product_id', 'quantity']);

        return $this->cart->updateProduct($request, $attributes, $attributes['product_id']);
    }

    // remove product
    public function removeProduct(Request $request, $product_id)
    {
        $validator = Validator::make(['product_id' => $product_id], [
            'product_id' => ['required', 'integer', new IsInCart]
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors(), 401);
        }

        return $this->cart->dissociateProduct($request, $product_id);
    }

    public function addProductFromRecipes(Request $request, $recipes)
    {
        $request->validate([
            'exportType' => ['in:export,cleanexport']
        ]);

        if ($request->exportType === 'cleanexport') {
            $cart = $this->cart->purgeCart($request);
        }

        $recipes->map(function($recipe) use($request) {
            $cart = $this->cart->addOrUpdateProducts($request, $recipe->products);
        });

        return $cart;
    }

}
