<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\index;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface IMIntEnt extends MainChannel
{
    /** @return array<string> */
    public function getBanChars(): array;

    /**
     * @return array{match: array<array{string,int<0, 4>,int,int}>, exact: array<array{string,int<0, 4>,int,int}>}
     */
    public function getSIdsEnt(string $key): array;
}
