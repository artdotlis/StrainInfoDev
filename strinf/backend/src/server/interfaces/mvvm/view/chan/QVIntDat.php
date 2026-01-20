<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view\chan;

use straininfo\server\shared\mvvm\view\api\VersionE;

interface QVIntDat
{
    /** @return array{string, bool} */
    public function getAvg(string $id, VersionE $version): array;

    /** @return array{string, bool} */
    public function getMax(string $id, VersionE $version): array;

    /** @return array{string, bool} */
    public function getMin(string $id, VersionE $version): array;
}
