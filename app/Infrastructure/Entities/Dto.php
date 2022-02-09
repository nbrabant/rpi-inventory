<?php

namespace App\Infrastructure\Entities;

/**
 * Class Dto
 * @package App\Infrastructure\Entities
 */
class Dto
{
    /**
     * Dto constructor.
     * @param mixed[] $args
     */
    public function __construct(array $args)
    {
        array_walk($args, function ($value, $key) {
            $this->{$key} = $value;
        });
    }
}