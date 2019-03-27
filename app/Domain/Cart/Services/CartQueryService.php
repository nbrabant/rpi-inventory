<?php

namespace App\Domain\Cart\Services;

use Illuminate\Http\Request;
use App\Domain\Cart\Repositories\CartRepository as Cart;

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
