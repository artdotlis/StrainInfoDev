<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StArcE: string
{
    case ARC_CON = 'archive';
    case DOI = 'doi';
    case DOI_ONLINE = 'online';
    case DATE = 'date';
    case TIT = 'title';
}
