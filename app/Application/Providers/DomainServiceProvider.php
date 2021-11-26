<?php

namespace App\Application\Providers;

use App\Infrastructure\Contracts\Provider\RouteProviderInterface;
use Illuminate\Support\ServiceProvider;

abstract class DomainServiceProvider extends ServiceProvider implements RouteProviderInterface
{
    /**
     * @var string $webNamespace
     */
    protected static string $webNamespace = '';

    /**
     * @var string $apiNamespace
     */
    protected static string $apiNamespace = '';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool $defer
     */
    protected bool $defer = true;

    /**
     * @var string[] $injections dependencies to inject
     */
    protected array $injections = [];

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