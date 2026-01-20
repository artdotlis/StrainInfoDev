<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructSubE: string
{
    case NAME = 'submitter_name';
    case INST = 'submitter_institute';
    case RCC = 'submitter_country_code';
    case PLA = 'submitter_place';
    case ROR = 'submitter_ror';
    case ORCID = 'submitter_orcid';
    case TYPE = 'submitter';
}
