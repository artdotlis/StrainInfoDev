<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdCul;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRSeaGetCul extends CaRSeaGet implements CaMIntSeaIdCul
{
    /**
     * @param array<int> $str_ids
     *
     * @return array<int, string>
     */
    public function getStrId(array $str_ids): array
    {
        return $this->getEntIds($str_ids, $this->wrId(RedisStE::STR->value));
    }

    protected function wrId(string $id): string
    {
        return RedisStE::P_CUL->value . $id . ':';
    }
}
