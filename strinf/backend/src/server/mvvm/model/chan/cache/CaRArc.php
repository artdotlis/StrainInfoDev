<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArc;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;
use straininfo\server\shared\mvvm\view_model\data\QDE;

final class CaRArc extends RedisMWr implements CaMIntArc
{
    /** @param callable(): \Redis|null $dbc */
    public function __construct(?callable $dbc)
    {
        parent::__construct($dbc, true);
    }

    /**
     * @param array<string> $ids
     *
     * @return array<string, string>
     */
    public function getArcBySiId(array $ids): array
    {
        return $this->getArcById($ids, RedisStE::P_ARC->value . QDE::MAX->value . ':');
    }

    /**
     * @param array<string> $ids
     *
     * @return array<string, string>
     */
    private function getArcById(array $ids, string $dbn): array
    {
        $this->checkMaintenanceMode();
        $pipe = $this->getDBC()->pipeline();
        foreach ($ids as $id) {
            $pipe = $pipe->get($dbn . $id);
        }
        $res = $pipe->exec();
        if (is_array($res)) {
            return array_filter(
                array_combine($ids, $res),
                static fn ($val) => \is_string($val) && strlen($val) > 0
            );
        }
        return [];
    }
}
