<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAllSet;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRAllSet extends RedisMWr implements CaMIntAllSet
{
    private readonly int $ex_s;
    private readonly int $limit;

    /** @param callable(): \Redis|null $dbc */
    public function __construct(?callable $dbc, int $ex_h, int $limit)
    {
        $this->ex_s = 3_600 * $ex_h;
        $this->limit = $limit;
        parent::__construct($dbc, true);
    }

    public function setAllCulIds(string $ids, int $cnt): void
    {
        $this->setRes($ids, RedisStE::ALL_CUL->value, $cnt);
    }

    public function setAllTCulIds(string $ids, int $cnt): void
    {
        $this->setRes($ids, RedisStE::ALL_TYP_CUL->value, $cnt);
    }

    public function setAllStrIds(string $ids, int $cnt): void
    {
        $this->setRes($ids, RedisStE::ALL_STR->value, $cnt);
    }

    public function setAllTStrIds(string $ids, int $cnt): void
    {
        $this->setRes($ids, RedisStE::ALL_TYP_STR->value, $cnt);
    }

    private function setRes(string $data, string $tag, int $cnt): void
    {
        $this->checkMaintenanceMode();
        if ($cnt < $this->limit) {
            $this->getDBC()->set($tag, $data, ['EX' => $this->ex_s]);
        }
    }
}
