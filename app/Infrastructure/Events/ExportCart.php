<?php

namespace App\Infrastructure\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ExportCart
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var string $products
     */
    private string $products;

    /**
     * @param string $products
     */
    public function __construct(string $products)
    {
        $this->products = $products;
    }

    public function getProducts(): string
    {
        return $this->products;
    }
}