<?php

declare(strict_types=1);

namespace straininfo\server\configs;

final class Config
{
    private const PRODUCTION = true;

    public static function isProductionBuild(): bool
    {
        return Config::PRODUCTION;
    }
}
