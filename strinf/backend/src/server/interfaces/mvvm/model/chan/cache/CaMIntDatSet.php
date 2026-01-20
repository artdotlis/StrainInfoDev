<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;
use straininfo\server\shared\mvvm\view\api\VersionE;

interface CaMIntDatSet extends MainChannel
{
    /** @param array<int, string> $data */
    public function setMin(array $data, VersionE $version, bool $perm): void;

    /** @param array<int, string> $data */
    public function setAvg(array $data, VersionE $version, bool $perm): void;

    /** @param array<int, string> $data */
    public function setMax(array $data, VersionE $version, bool $perm): void;
    /** @param array<int, string> $data */
    public function setMic(array $data): void;
    /** @param array<int, string> $data */
    public function setMicInd(array $data): void;
}
