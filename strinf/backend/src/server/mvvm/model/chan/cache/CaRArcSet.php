<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArcSet;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;
use straininfo\server\shared\mvvm\view_model\data\QDE;

final class CaRArcSet extends RedisMWr implements CaMIntArcSet
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

    /** @param array<string, string> $data */
    public function setArcBySiId(array $data): void
    {
        $this->setArcById($data, RedisStE::P_ARC->value . QDE::MAX->value . ':');
    }

    /** @param array<string, string> $data */
    private function setArcById(array $data, string $dbn): void
    {
        $this->checkMaintenanceMode();
        if (count($data) < $this->limit) {
            $ex_s = $this->ex_s;
            $pipe = $this->getDBC()->pipeline();
            foreach ($data as $id => $json) {
                $pipe = $pipe->set($dbn . $id, $json, ['EX' => $ex_s]);
            }
            $pipe->exec();
        }
    }
}
