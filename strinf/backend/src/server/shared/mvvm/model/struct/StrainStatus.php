<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\struct;

enum StrainStatus: string
{
    case ERR = 'erroneous';
    case PUB_ON = 'published online';
    case PUB_OFF = 'published offline';
    case UND_DEP = 'deposition';
}
