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
    protected static $webNamespace = 'App\Domain\Configuration\Http\Controllers';

    /**
     * @var string $apiNamespace
     */
    protected static $apiNamespace = 'App\Domain\Configuration\Http\Resources';

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
        ConfigurationRepositoryInterface::class => ConfigurationRepository::class,
    ];
}