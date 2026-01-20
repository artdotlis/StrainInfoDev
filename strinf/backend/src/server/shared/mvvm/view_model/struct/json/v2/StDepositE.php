<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StDepositE: string
{
    // con
    case CON = 'deposit';
    case HIST = 'history';
    // min
    case SI_DP = 'siDP';
    case DES = 'designation';
    case CAT = 'catalogue';
    case CAT_URL = 'url';
    case CAT_ON = 'online';
    case STATUS = 'status';
    case TYP_STR = 'typeStrain';
    case DATA_SRC = 'dataSource';
    // info
    case HIST_ENC = 'encoded';
    case BAC_DIVE = 'bdID';
    case UPDATE = 'lastUpdate';
}
