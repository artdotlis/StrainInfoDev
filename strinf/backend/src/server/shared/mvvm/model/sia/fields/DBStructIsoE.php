<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructIsoE: string
{
    // sample
    case SAM_SRC = 'sam_src';
    case SAM_CC = 'sam_cc';
    case SAM_DATE = 'sam_date';
    case SAM_PLA = 'sam_place';
    // isolation
    case YEAR = 'iso_year';
    //isolator
    case NAME = 'iso_name';
    case INST = 'iso_institute';
    case DCC = 'iso_country_code';
    case PLA = 'iso_place';
    case ROR = 'iso_ror';
    case ORCID = 'iso_orcid';
    case CONTR = 'iso_contribution';
}
