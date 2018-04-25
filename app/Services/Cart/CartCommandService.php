<?php

namespace App\Services\Cart;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Cart\CartRepository as Cart;
use App\Repositories\Cart\CartProductRepository as CartProduct;
use Validator;
use App\Rules\NotInCart;

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
        $validator = Validator::make($request->all(), [
            'product_id' => ['required', 'integer', new NotInCart],
            'quantity' => 'required|integer'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator->errors(), 401);
        }

        $attributes = $request->only(['product_id', 'quantity']);
Log::info($attributes);
        $cart = $this->cart->getCurrentOrCreate($request);
        // $cart->productLines()->create($attributes);

        return $cart;
    }

    // update product
    // send cart to trello
    // export to pdf


}
