<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\query;

interface QVMIntAll
{
    /** @return array<int> */
    public function getResult(): array;

    /** @param array<int> $ids */
    public function createJson(array $ids): string;

    /** @return array<int> */
    public function parseJson(string $json): array;
}
