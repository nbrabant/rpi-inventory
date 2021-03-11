<?php

namespace App\Domain\Cart;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Contracts\CartRepositoryInterface;
use App\Domain\Cart\Entities\Cart;
use App\Domain\Cart\Repositories\CartRepository;
use App\Infrastructure\Contracts\Provider\RouteProviderInterface;
use Illuminate\Support\ServiceProvider;

class CartServiceProvider extends ServiceProvider implements RouteProviderInterface
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

    public function register()
    {
        $this->registerContracts();
    }

    /**
     * @return string
     */
    public static function getWebNamespace(): string
    {
        return self::$webNamespace;
    }

    /**
     * @return string
     */
    public static function getApiNamespace(): string
    {
        return self::$apiNamespace;
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