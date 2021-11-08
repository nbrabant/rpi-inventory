<?php

namespace App\Domain\Configuration\Http\Resources;

use App\Domain\Configuration\Contracts\ConfigurationRepositoryInterface;
use Illuminate\Http\Request;

class Configurations
{
    public const CONFIGURATION_PREFIXES = [
        'trello'
    ];
    /**
     * @var ConfigurationRepositoryInterface
     */
    private $configurationRepository;

    public function __construct(ConfigurationRepositoryInterface $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;
    }

    /**
     * @return array|mixed[]
     */
    public function show()
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
     * @return array|mixed[]
     */
    public function store(Request $request)
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