<?php

namespace App\Domain\Schedule;

use App\Application\Providers\DomainServiceProvider;
use App\Domain\Schedule\Contracts\ScheduleRepositoryInterface;
use App\Domain\Schedule\Repositories\ScheduleRepository;

class ScheduleServiceProvider extends DomainServiceProvider
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

}