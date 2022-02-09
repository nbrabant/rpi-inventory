<?php

namespace App\Domain\Cart\Http\Requests;

interface CartProductRequestInterface
{
    /**
     * @return int
     */
    public function getProductId(): int;

    /**
     * @return int
     */
    public function getQuantity(): int;
}