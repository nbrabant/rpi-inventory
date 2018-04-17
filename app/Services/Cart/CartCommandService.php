<?php

namespace App\Services\Cart;

use Illuminate\Http\Request;
use App\Exceptions\ValidationException;
use App\Repositories\Cart\CartRepository as Cart;
use Validator;

class CartCommandService
{
    private $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    // add product
    // send cart to trello
    // export to pdf


}
