<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\query;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface QMIntAll extends MainChannel
{
    /** @return array<int> */
    public function getAllCulIds(): array;

    /** @return array<int> */
    public function getAllStrIds(): array;

    /** @return array<int> */
    public function getAllTStrIds(): array;

    /** @return array<array{int, string}> */
    public function getAllStrIdsWDate(): array;

    /** @return array<int> */
    public function getAllTCulIds(): array;
}
