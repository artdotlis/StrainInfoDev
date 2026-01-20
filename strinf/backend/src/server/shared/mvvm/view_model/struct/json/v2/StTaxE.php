<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StTaxE: string
{
    case TAX_CON = 'taxon';
    case NAME = 'name';
    case NCBI = 'ncbi';
    case LPSN = 'lpsn';
}
