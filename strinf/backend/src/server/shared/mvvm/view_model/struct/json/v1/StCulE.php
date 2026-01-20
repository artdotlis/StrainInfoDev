<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v1;

enum StCulE: string
{
    // con
    case CON = 'culture';
    case HIST = 'history';
    // min
    case CUL_ID = 'id';
    case STR_NO = 'strain_number';
    case CAT = 'catalogue';
    case CAT_URL = 'url';
    case CAT_ON = 'online';
    case STATUS = 'status';
    case TYP_CUL = 'type_culture';
    case TYP_STR = 'type_strain';
    case DATA_SRC = 'data_source';
    // info
    case COMMENT = 'comment';
    case HIST_ENC = 'encoded';
    case BAC_DIVE = 'bacdive';
    case UPDATE = 'last_update';
}
