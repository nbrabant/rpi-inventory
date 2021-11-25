<?php

namespace App\Domain\Stock;

use App\Application\Providers\DomainServiceProvider;
use App\Domain\Stock\Contracts\CategoryRepositoryInterface;
use App\Domain\Stock\Contracts\OperationRepositoryInterface;
use App\Domain\Stock\Contracts\ProductRepositoryInterface;
use App\Domain\Stock\Repositories\CategoryRepository;
use App\Domain\Stock\Repositories\OperationRepository;
use App\Domain\Stock\Repositories\ProductRepository;

class StockServiceProvider extends DomainServiceProvider
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
     * @var bool $defer
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

}