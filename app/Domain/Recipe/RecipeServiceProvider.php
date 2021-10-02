<?php

namespace App\Domain\Recipe;

use App\Application\Providers\DomainServiceProvider;
use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Contracts\RecipeRepositoryInterface;
use App\Domain\Recipe\Entities\Recipe;
use App\Domain\Recipe\Repositories\RecipeRepository;

class RecipeServiceProvider extends DomainServiceProvider
{
    /**
     * @var string $webNamespace
     */
    protected static $webNamespace = 'App\Domain\Recipe\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static $apiNamespace = 'App\Domain\Recipe\Http\Resources';

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
        RecipeInterface::class => Recipe::class,
        RecipeRepositoryInterface::class => RecipeRepository::class,
    ];

}