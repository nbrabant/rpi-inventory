<?php

namespace App\Domain\Cart;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\CartRepositoryInterface;
use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Repositories\CartRepository;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * @var string[] $injections dependencies to inject
     */
    protected $injections = [
        CartInterface::class => Cart::class,
        CartRepositoryInterface::class => CartRepository::class,
    ];

    public function register()
    {
        $this->registerContracts();
    }

    /**
     * Bind Contracts
     *
     * @return void
     */
    protected function registerContracts()
    {
        foreach ($this->injections as $interface => $contract) {
            $this->app->bind($interface, $contract);
        }
    }

}