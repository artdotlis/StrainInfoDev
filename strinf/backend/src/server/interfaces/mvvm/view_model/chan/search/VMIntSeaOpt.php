<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\search;

interface VMIntSeaOpt
{
    /**
     * @param array<int, string> $strains
     *
     * @return array{string, bool}
     */
    public function createMicJson(array $strains): array;

    /**
     * @param array<int, string> $strains
     */
    public function createMicAllJson(array $strains, int $ind, int $cnt): string;
}
