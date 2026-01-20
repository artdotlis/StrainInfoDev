<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v1;

enum StSeqE: string
{
    case SEQ_CON = 'sequence';
    case SEQ_CUL_CON = 'culture';
    case ACC_NR = 'accession_number';
    case SEQ_L = 'length';
    case DESC = 'description';
    case YEAR = 'year';
    case TYP = 'type';
    case ASS = 'assembly_level';
    case CUL_ID = 'id';
    case STR_NO = 'strain_number';
}
