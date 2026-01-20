<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v2;

enum QDepE: string
{
    case ID_P = 'si_dp';
    case AVG = '/v2/data/deposit/avg/{si_dp:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
    case MAX = '/v2/data/deposit/max/{si_dp:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
    case MIN = '/v2/data/deposit/min/{si_dp:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
}
