<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAll;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRAll extends RedisMWr implements CaMIntAll
{
    /** @param callable(): \Redis|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    public function getAllCulIds(): string
    {
        return $this->getRes(RedisStE::ALL_CUL->value);
    }

    public function getAllStrIds(): string
    {
        return $this->getRes(RedisStE::ALL_STR->value);
    }

    public function getAllTStrIds(): string
    {
        return $this->getRes(RedisStE::ALL_TYP_STR->value);
    }

    public function getAllTCulIds(): string
    {
        return $this->getRes(RedisStE::ALL_TYP_CUL->value);
    }

    public function getRes(string $tag): string
    {
        $this->checkMaintenanceMode();
        $res = $this->getDBC()->get($tag);
        if (is_string($res)) {
            return $res;
        }
        return '';
    }
}
