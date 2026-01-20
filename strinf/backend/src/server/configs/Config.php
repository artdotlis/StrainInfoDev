<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

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
