<?php

namespace App\Domain\Cart;

use App\Application\Providers\DomainServiceProvider;
use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\CartRepositoryInterface;
use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Repositories\CartRepository;
use App\Domain\Cart\Requests\Rules\IsInCart;
use App\Domain\Cart\Requests\Rules\NotInCart;
use Illuminate\Support\Facades\App;

class CartServiceProvider extends DomainServiceProvider
{
    /**
     * @var string $webNamespace
     */
    protected static string $webNamespace = 'App\Domain\Cart\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static string $apiNamespace = 'App\Domain\Cart\Http\Resources';

    /**
     * @var string[] $injections dependencies to inject
     */
    protected array $injections = [
        CartInterface::class => Cart::class,
        CartRepositoryInterface::class => CartRepository::class,
    ];
}