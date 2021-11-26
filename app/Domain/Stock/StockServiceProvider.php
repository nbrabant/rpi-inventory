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
    protected static string $webNamespace = 'App\Domain\Stock\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static string $apiNamespace = 'App\Domain\Stock\Http\Resources';

    /**
     * @var string[] $injections dependencies to inject
     */
    protected array $injections = [
        CategoryRepositoryInterface::class => CategoryRepository::class,
        ProductRepositoryInterface::class => ProductRepository::class,
        OperationRepositoryInterface::class => OperationRepository::class,
    ];

}