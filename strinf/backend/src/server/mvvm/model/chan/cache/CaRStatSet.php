<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStatSet;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRStatSet extends RedisMWr implements CaMIntStatSet
{
    /** @param callable(): \Redis|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    public function setCulPStrCnt(string $data): void
    {
        $this->setRes($data, RedisStE::DIS_CPS_CNT->value);
    }

    private function setRes(string $data, string $tag): void
    {
        $this->checkMaintenanceMode();
        $this->getDBC()->set($tag, $data);
    }
}
