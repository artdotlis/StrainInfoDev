<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v1;

enum QCulE: string
{
    case ID_P = 'cul_id';
    case AVG = '/v1/data/culture/avg/{cul_id:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
    case MAX = '/v1/data/culture/max/{cul_id:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
    case MIN = '/v1/data/culture/min/{cul_id:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
}
