<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructCulE: string
{
    // min
    case CULTURE_ID = 'culture_id';
    case STRAIN_NUMBER = 'strain_number';
    case CAT = 'catalogue';
    case CAT_ON = 'catalogue_online';
    case STATUS = 'status';
    case TYP_CUL = 'c_type_culture';
    case TYP_STR = 'c_type_strain';
    case DATA_SRC = 'data_source';
    case CCNO_ID = 'ccno_id';
    case REG_DATE = 'cul_reg_date';
    // avg
    case COMMENT = 'c_comment';
    case HIST = 'encoded_history';
    case BAC_DIVE = 'c_bac_dive';
    case UPDATE = 'last_update';
}
