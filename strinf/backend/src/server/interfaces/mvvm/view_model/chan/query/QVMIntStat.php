<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\query;

/** @template T */
interface QVMIntStat
{
    /** @return array<string, array<T>> */
    public function getResult(): array;

    /** @param array<string, array<T>> $dis */
    public function createJson(array $dis): string;
}
