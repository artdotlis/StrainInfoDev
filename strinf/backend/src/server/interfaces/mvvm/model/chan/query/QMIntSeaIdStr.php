<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\query;

interface QMIntSeaIdStr extends QMIntSeaId
{
    /**
     * @param array<int> $cul_id
     *
     * @return array<int>
     */
    public function getCulId(array $cul_id): array;
}
