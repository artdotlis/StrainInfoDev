<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\logger;

function parse_lle(string $val): LogLevE
{
    foreach (LogLevE::cases() as $case) {
        if ($case->value === $val) {
            return $case;
        }
    }
    return LogLevE::NOTICE;
}
