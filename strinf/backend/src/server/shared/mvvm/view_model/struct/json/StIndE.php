<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json;

enum StIndE: string
{
    case F_KEY = 'fullKey';
    case PATH = 'path';
    case STR_ID = 'siID';
    case STR_CNT = 'strainCount';
}
