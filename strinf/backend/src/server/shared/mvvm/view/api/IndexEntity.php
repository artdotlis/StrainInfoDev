<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api;

enum IndexEntity: int
{
    case TAX = 0;
    case SEQ_ACC = 1;
    case DES = 2;
    case CCNO_DES = 3;
    case BRC = 4;
}
