<?php

namespace App\Domain\Configuration\Http\Resources;

use App\Domain\Configuration\Contracts\ConfigurationRepositoryInterface;
use Illuminate\Http\Request;

/**
 * @property ConfigurationRepositoryInterface $configurationRepository
 */
class Configurations
{
    /**
     * @var string CONFIGURATION_PREFIXES
     */
    public const CONFIGURATION_PREFIXES = [
        'trello'
    ];

    /**
     * @param ConfigurationRepositoryInterface $configurationRepository
     */
    public function __construct(
        ConfigurationRepositoryInterface $configurationRepository
    ) {
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * @return mixed[]
     */
    public function show(): array
    {
        return array_reduce(self::CONFIGURATION_PREFIXES, function ($configurations, $prefix) {
            $configurations[$prefix] = $this->configurationRepository->getList($prefix);
            return $configurations + [$prefix => $this->configurationRepository->getList($prefix)];
        }, []);
    }

    /**
     * Update configuration
     *
     * @param Request $request
     * @return mixed[]
     */
    public function store(Request $request): array
    {
        foreach ($request->all() as $prefix => $configurations) {
            if (!in_array($prefix, self::CONFIGURATION_PREFIXES)) {
                continue;
            }

            $this->configurationRepository->save($prefix, $configurations);
        }

        return $this->show();
    }
}