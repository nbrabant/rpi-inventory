<?php

namespace App\Domain\Configuration;

use App\Application\Providers\DomainServiceProvider;
use App\Domain\Configuration\Contracts\ConfigurationRepositoryInterface;
use App\Domain\Configuration\Repositories\ConfigurationRepository;

class ConfigurationServiceProvider extends DomainServiceProvider
{
    /**
     * @var string $webNamespace
     */
    protected static string $webNamespace = 'App\Domain\Configuration\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static string $apiNamespace = 'App\Domain\Configuration\Http\Resources';

    /**
     * @var string[] $injections dependencies to inject
     */
    protected array $injections = [
        ConfigurationRepositoryInterface::class => ConfigurationRepository::class,
    ];
}