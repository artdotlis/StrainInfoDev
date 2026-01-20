<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StDepositionE: string
{
    case DEP_CON = 'deposition';
    case DEP_ENT_CON = 'depositor';
    case O_SI_DP = 'origin';
    case O_DES = 'designation';
    case YEAR = 'year';
    case D_NAME = 'name';
    case D_INST = 'institute';
    case D_CC = 'countryCode';
    case D_PLA = 'place';
    case D_ROR = 'ror';
    case D_ORCID = 'orcid';
    case D_CONTR = 'contributor';
}
