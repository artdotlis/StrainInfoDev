<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v1;

enum StBrcE: string
{
    case BRC_CON = 'brc';
    case BRC_HOME = 'homepage';
    case BRC_URL = 'url';
    case BRC_ON = 'online';
    case B_ID = 'id';
    case B_NAME = 'name';
    case B_CC = 'country_code';
    case B_ROR = 'ror';
    case B_ACT = 'active';
    case B_DEPR = 'deprecated';
    case B_GBIF = 'gbif';
    case B_CODE = 'code';
}
