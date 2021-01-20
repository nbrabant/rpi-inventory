<?php

namespace App\Domain\Stock;

use App\Domain\Stock\Contracts\CategoryRepositoryInterface;
use App\Domain\Stock\Contracts\OperationRepositoryInterface;
use App\Domain\Stock\Contracts\ProductRepositoryInterface;
use App\Domain\Stock\Repositories\CategoryRepository;
use App\Domain\Stock\Repositories\OperationRepository;
use App\Domain\Stock\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class StockServiceProvider extends ServiceProvider
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
        CategoryRepositoryInterface::class => CategoryRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        OperationRepositoryInterface::class => OperationRepository::class,
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