<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v1;

enum StStrE: string
{
    // con
    case CON = 'strain';
    case MERGE_CON = 'merged';
    case SAM_CON = 'sample';
    case CUL = 'cultures';
    case STA = 'status';
    // info
    case STR_ID = 'id';
    case STR_DOI = 'doi';
    case STR_DOI_ON = 'doi_online';
    case TYP_CUL = 'type_culture';
    // pass
    case TYP_STR = 'type_strain';
    case BAC_DIVE = 'bacdive';
    case SAM_SRC = 'source';
    case SAM_CC = 'country_code';
}
