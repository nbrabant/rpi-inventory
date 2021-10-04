<?php

namespace App\Domain\Configuration\Contracts;

interface ConfigurationRepositoryInterface
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