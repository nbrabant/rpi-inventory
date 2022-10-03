<?php

namespace App\Domain\Cart\Events;

use App\Domain\Cart\Entities\Cart;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\SerializesModels;

class CartFinished implements ShouldQueue
{
    use SerializesModels;

    /**
     * @var Cart $cart
     */
    private Cart $cart;

    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function shouldQueue(): bool
    {
        return $this->cart->finished ||
            $this->cart->getOriginal('finished');
    }

    public function getProducts(): string
    {
        return $this->cart->productLines;
    }
}