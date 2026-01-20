<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructSeqE: string
{
    case SEQ_ID = 'id';
    case ACC_NR = 'accession_number';
    case SEQ_L = 'length';
    case DESC = 'description';
    case YEAR = 'year';
    case ASS = 'assembly_level';
    case TYP = 'type';
    case CUL = 'cul_id';
    case CUL_DES = 'cul_des';
}
