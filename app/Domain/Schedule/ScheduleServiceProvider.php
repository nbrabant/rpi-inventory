<?php

namespace App\Domain\Schedule;

use App\Domain\Schedule\Contracts\ScheduleRepositoryInterface;
use App\Domain\Schedule\Repositories\ScheduleRepository;
use App\Infrastructure\Contracts\Provider\RouteProviderInterface;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider implements RouteProviderInterface
{
    /**
     * @var string $webNamespace
     */
    protected static $webNamespace = 'App\Domain\Schedule\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static $apiNamespace = 'App\Domain\Schedule\Http\Resources';

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
        ScheduleRepositoryInterface::class => ScheduleRepository::class
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