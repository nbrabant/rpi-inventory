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
        // @todo : build config with CONFIGURATION_PREFIXES
        return $this->configurationRepository->getList('trello');
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