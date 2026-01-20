<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\types;

/**
 * @template E
 *
 * @param E $val
 */
function parse_int($val): int
{
    if (is_numeric($val)) {
        return (int) $val;
    }
    return -1;
}
