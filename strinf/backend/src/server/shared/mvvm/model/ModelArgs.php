<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model;

final class ModelArgs
{
    public function __construct(
        private readonly \DateTimeZone $time_zone,
        private readonly int $maintenance
    ) {
    }

    public function getTimeZone(): \DateTimeZone
    {
        return $this->time_zone;
    }

    public function getMaintenance(): int
    {
        return $this->maintenance;
    }
}
