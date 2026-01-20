<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructArcE: string
{
    case DOI = 'strain_doi';
    case DOI_ONLINE = 'strain_doi_online';
    case DATE = 'archived';
    case ARC = 'archive';
    case TIT = 'title';
}
