<?php

namespace App\Services\Cart;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Cart\CartRepository as Cart;

class CartQueryService
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function getCurrent(Request $request)
    {
        return $this->cart->getCurrentOrCreate($request);
    }

}
