<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructBrcE: string
{
    case B_ID = 'b_id';
    case B_CC = 'b_country_code';
    case B_NAME = 'b_name';
    case B_ROR = 'b_ror';
    case B_ACT = 'b_active';
    case B_DEPR = 'b_deprecated';
    case B_GBIF = 'b_gbif';
    case B_CODE = 'b_code';
    case B_HOME = 'b_online';
    case B_ON = 'b_homepage';
}
