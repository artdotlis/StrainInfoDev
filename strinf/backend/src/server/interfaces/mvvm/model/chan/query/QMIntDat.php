<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\query;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

/** @template TV */
interface QMIntDat extends MainChannel
{
    /**
     * @param array<int> $ids
     *
     * @return array<TV>
     */
    public function getMin(array $ids): array;

    /**
     * @param array<int> $ids
     *
     * @return array<TV>
     */
    public function getAvg(array $ids): array;

    /**
     * @param array<int> $ids
     *
     * @return array<TV>
     */
    public function getMax(array $ids): array;
}
