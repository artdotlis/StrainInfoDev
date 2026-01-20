<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\path;

enum QUIMap: string
{
    case STRAIN = '/strain';
    case SITEMAP = '/sitemap_index.xml';
    case ROBOT = '/robots.txt';
}
