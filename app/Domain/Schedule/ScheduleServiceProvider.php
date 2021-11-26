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
    protected static string $webNamespace = 'App\Domain\Schedule\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static string $apiNamespace = 'App\Domain\Schedule\Http\Resources';


    /**
     * @var string[] $injections dependencies to inject
     */
    protected array $injections = [
        ScheduleRepositoryInterface::class => ScheduleRepository::class
    ];

}