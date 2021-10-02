<?php

namespace App\Infrastructure\Contracts\Provider;

interface RouteProviderInterface
{
    public static function getWebNamespace(): string;

    public static function getApiNamespace(): string;
}