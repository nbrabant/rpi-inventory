<?php

namespace App\Services\Cart;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Cart\CartRepository as Cart;
use App\Repositories\Cart\CartProductRepository as CartProduct;
use Validator;
use App\Rules\NotInCart;
use App\Rules\IsInCart;

use Illuminate\Support\Facades\Log;

class CartCommandService
{
    private $cart;

    private $cartProduct;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
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

    // send cart to trello
    // export to pdf


}
