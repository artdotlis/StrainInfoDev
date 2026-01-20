<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStat;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRStat extends RedisMWr implements CaMIntStat
{
    /** @param callable(): \Redis|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    public function getCulPStrCnt(): string
    {
        return $this->getRes(RedisStE::DIS_CPS_CNT->value);
    }

    public function getRes(string $tag): string
    {
        $this->checkMaintenanceMode();
        $res = $this->getDBC()->get($tag);
        if (\is_string($res)) {
            return $res;
        }
        return '';
    }
}
