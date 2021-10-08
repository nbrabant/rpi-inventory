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
    public function index()
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
     */
    public function store(Request $request)
    {
        // @todo : safety clean
        foreach ($request->configurations as $prefix => $configurations) {
            $this->configurationRepository->save($prefix, $configurations);
        }
    }
}