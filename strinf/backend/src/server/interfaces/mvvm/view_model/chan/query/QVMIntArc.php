<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\query;

interface QVMIntArc
{
    /** @return array<string> */
    public function parseArg(string $arg): array;

    /**
     * @param array<string> $arg
     *
     * @return array<string, string>
     */
    public function getResult(array $arg): array;

    /** @param array<string, string> $res */
    public function createJson(array $res): string;
}
