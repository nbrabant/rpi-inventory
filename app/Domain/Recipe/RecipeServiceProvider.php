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
    protected static string $webNamespace = 'App\Domain\Recipe\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static string $apiNamespace = 'App\Domain\Recipe\Http\Resources';

    /**
     * @var string[] $injections dependencies to inject
     */
    protected array $injections = [
        RecipeInterface::class => Recipe::class,
        RecipeRepositoryInterface::class => RecipeRepository::class,
    ];

}