<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api;

use straininfo\server\shared\mvvm\view\api\query\service\QAllE;

/** @return array<string> */
function create_all_api_str(): array
{
    return array_map(
        static fn (QAllE $enum_el): string => $enum_el->value,
        QAllE::cases()
    );
}
