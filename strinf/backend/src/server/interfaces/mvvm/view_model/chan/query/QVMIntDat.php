<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\query;

use straininfo\server\shared\mvvm\view\api\VersionE;

/** @template TV */
interface QVMIntDat
{
    /** @return array<int> */
    public function parseArg(string $arg): array;

    /**
     * @param array<int> $arg
     *
     * @return array<int, TV>
     */
    public function getResult(array $arg, VersionE $version): array;

    /** @param array<int, string> $res */
    public function createJson(array $res): string;

    /**
     * @param array<int, TV> $res
     *
     * @return array<int, string>
     */
    public function createJsonList(array $res): array;
}
