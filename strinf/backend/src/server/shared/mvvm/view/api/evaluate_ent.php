<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api;

use straininfo\server\exceptions\mvvm\model\KnownDBExc;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;
use straininfo\server\shared\mvvm\view\api\query\v2\QSeaStrIE;

function map_ent_to_api(IndexEntity $ent): string
{
    return match ($ent) {
        IndexEntity::BRC => QSeaStrIE::CC_F->value,
        IndexEntity::CCNO_DES => QSeaStrIE::CC_NO_F->value,
        IndexEntity::TAX => QSeaStrIE::TAX_NAME_F->value,
        IndexEntity::SEQ_ACC => QSeaStrIE::SEQ_ACC_F->value,
        default => QSeaStrIE::DES_F->value
    };
}

function map_integer_to_ent(int $ent): IndexEntity
{
    $value = IndexEntity::tryFrom($ent);
    if ($value !== null) {
        return $value;
    }
    throw new KnownDBExc(
        'Could not find enum index: ' . $ent,
        LogLevE::ERROR,
        KEAct::WARN
    );
}
