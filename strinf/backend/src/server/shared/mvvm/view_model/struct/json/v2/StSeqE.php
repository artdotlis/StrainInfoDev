<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StSeqE: string
{
    case SEQ_CON = 'sequence';
    case SEQ_DEP_CON = 'deposit';
    case ACC_NR = 'accessionNumber';
    case SEQ_L = 'length';
    case DESC = 'description';
    case YEAR = 'year';
    case TYP = 'type';
    case ASS = 'assemblyLevel';
    case SI_DP = 'siDP';
    case DES = 'designation';
}
