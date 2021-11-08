<?php

namespace App\Domain\Configuration\Repositories;

use App\Domain\Configuration\Contracts\ConfigurationInterface;
use App\Domain\Configuration\Contracts\ConfigurationRepositoryInterface;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\File;

class ConfigurationRepository implements ConfigurationRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function getList(string $prefix): array
    {
        return Config::get($prefix);
    }

    /**
     * @inheritDoc
     */
    public function save(string $prefix, array $configurations): bool
    {
        $configs = Config::get($prefix);

        foreach ($configurations as $key => $value) {
            $configs[$key] = $value;
        }
        $configContent = var_export($configs, 1);
        return (File::put(
            config_path() . '/' . $prefix . '.php',
            "<?php \n return $configContent ;")
        );
    }
}