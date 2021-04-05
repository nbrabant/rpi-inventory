<?php

namespace App\Domain\Cart;

use App\Application\Providers\DomainServiceProvider;
use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\CartRepositoryInterface;
use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Repositories\CartRepository;

class CartServiceProvider extends DomainServiceProvider
{
    /**
     * @var string $webNamespace
     */
    protected static $webNamespace = 'App\Domain\Cart\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static $apiNamespace = 'App\Domain\Cart\Http\Resources';

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

}