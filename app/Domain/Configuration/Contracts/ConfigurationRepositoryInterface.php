<?php

namespace App\Domain\Configuration\Contracts;

use App\Infrastructure\Contracts\BaseRepositoryInterface;

interface ConfigurationRepositoryInterface extends BaseRepositoryInterface
{
    /**
     * Retrieve configurations by prefix
     *
     * @param string $prefix
     * @return mixed[]
     */
    public function getList(string $prefix): array;

    /**
     * Persist a configuration
     *
     * @param string $prefix
     * @param array $configurations
     * @return bool
     */
    public function save(string $prefix, array $configurations): bool;
}