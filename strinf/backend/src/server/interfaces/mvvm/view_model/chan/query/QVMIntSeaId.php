<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\query;

/** @template T of string|int */
interface QVMIntSeaId
{
    /**
     * @param array<T> $arg
     *
     * @return array<T, array<int>>
     */
    public function getResult(array $arg): array;

    /** @return array<T> */
    public function parseArg(string $arg): array;

    public function createJson(string $ids): string;
}
