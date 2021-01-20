<?php

namespace App\Domain\Recipe;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Contracts\RecipeRepositoryInterface;
use App\Domain\Recipe\Entities\Recipe;
use App\Repositories\Recipe\RecipeRepository;
use Illuminate\Support\ServiceProvider;

class RecipeServiceProvider extends ServiceProvider
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
        RecipeInterface::class => Recipe::class,
        RecipeRepositoryInterface::class => RecipeRepository::class,
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