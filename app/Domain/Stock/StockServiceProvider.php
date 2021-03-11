<?php

namespace App\Domain\Stock;

use App\Domain\Stock\Contracts\CategoryRepositoryInterface;
use App\Domain\Stock\Contracts\OperationRepositoryInterface;
use App\Domain\Stock\Contracts\ProductRepositoryInterface;
use App\Domain\Stock\Repositories\CategoryRepository;
use App\Domain\Stock\Repositories\OperationRepository;
use App\Domain\Stock\Repositories\ProductRepository;
use App\Infrastructure\Contracts\Provider\RouteProviderInterface;
use Illuminate\Support\ServiceProvider;

class StockServiceProvider extends ServiceProvider implements RouteProviderInterface
{
    /**
     * @var string $webNamespace
     */
    protected static $webNamespace = 'App\Domain\Stock\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static $apiNamespace = 'App\Domain\Stock\Http\Resources';

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
        CategoryRepositoryInterface::class => CategoryRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        OperationRepositoryInterface::class => OperationRepository::class,
    ];

    public function register()
    {
        $this->registerContracts();
    }

    public static function getWebNamespace(): string
    {
        return self::$webNamespace;
    }

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