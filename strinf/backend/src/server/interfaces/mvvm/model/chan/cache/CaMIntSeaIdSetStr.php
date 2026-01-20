<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

interface CaMIntSeaIdSetStr extends CaMIntSeaIdSet
{
    /** @param array<int, array<int>> $cul_id */
    public function setCulId(array $cul_id): void;
}
