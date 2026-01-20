<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructTaxE: string
{
    case C_NAME = 'c_tax_name';
    case C_NCBI = 'c_tax_ncbi';
    case C_LPSN = 'c_tax_lpsn';
    case S_NAME = 's_tax_name';
    case S_NCBI = 's_tax_ncbi';
    case S_LPSN = 's_tax_lpsn';
}
