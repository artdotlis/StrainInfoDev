<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetStr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRSeaSetStr extends CaRSeaSet implements CaMIntSeaIdSetStr
{
    /** @param array<int, array<int>> $cul_ids */
    public function setCulId(array $cul_ids): void
    {
        $this->setSea($cul_ids, $this->wrId(RedisStE::CUL->value), $this->ex_s);
    }
    protected function wrId(string $id): string
    {
        return RedisStE::P_STR->value . $id . ':';
    }
}
