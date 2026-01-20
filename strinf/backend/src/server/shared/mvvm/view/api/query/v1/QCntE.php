<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v1;

enum QCntE: string
{
    case STR_CNT = '/v1/count/strains';
    case ARC_CNT = '/v1/count/archive';
    case CUL_CNT = '/v1/count/cultures';
    case SPE_CNT = '/v1/count/species';
    case DES_CNT = '/v1/count/designations';
    case STR_TYP_CNT = '/v1/count/type_strains';
    case CUL_TYP_CNT = '/v1/count/type_cultures';
}
