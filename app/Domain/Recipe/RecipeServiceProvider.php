<?php

namespace App\Domain\Recipe;

use App\Domain\Recipe\Contracts\RecipeInterface;
use App\Domain\Recipe\Contracts\RecipeRepositoryInterface;
use App\Domain\Recipe\Entities\Recipe;
use App\Infrastructure\Contracts\Provider\RouteProviderInterface;
use App\Domain\Recipe\Repositories\RecipeRepository;
use Illuminate\Support\ServiceProvider;

class RecipeServiceProvider extends ServiceProvider implements RouteProviderInterface
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