<?php

namespace App\Domain\Schedule;

use App\Domain\Schedule\Contracts\ScheduleRepositoryInterface;
use App\Domain\Schedule\Repositories\ScheduleRepository;
use Illuminate\Support\ServiceProvider;

class ScheduleServiceProvider extends ServiceProvider
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
        ScheduleRepositoryInterface::class => ScheduleRepository::class
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