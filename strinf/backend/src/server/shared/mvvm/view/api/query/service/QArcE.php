<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\service;

enum QArcE: string
{
    case ID_P = 'si_id';
    case ARC = '/service/archive/strain/si_id/{si_id:SI-ID\s*[0-9]+\.[0-9]+(?:,SI-ID\s*[0-9]+\.[0-9]+)*}';
}
