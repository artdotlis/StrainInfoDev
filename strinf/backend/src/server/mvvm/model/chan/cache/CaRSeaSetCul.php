<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetCul;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRSeaSetCul extends CaRSeaSet implements CaMIntSeaIdSetCul
{
    /** @param array<int, array<int>> $str_ids */
    public function setStrId(array $str_ids): void
    {
        $this->setSea($str_ids, $this->wrId(RedisStE::STR->value), $this->ex_s);
    }

    protected function wrId(string $id): string
    {
        return RedisStE::P_CUL->value . $id . ':';
    }
}
