<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDat;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\view\api\VersionE;
use straininfo\server\shared\mvvm\view_model\data\QDE;

final class CaRDat extends RedisMWr implements CaMIntDat
{
    private readonly string $prefix;

    /** @param callable(): \Redis|null $dbc */
    public function __construct(?callable $dbc, string $prefix)
    {
        $this->prefix = $prefix;
        parent::__construct($dbc, true);
    }

    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    public function getMin(array $ids, VersionE $version): array
    {
        return $this->getEntById(
            $ids,
            $this->prefix .  $version->value .'_'.QDE::MIN->value . ':'
        );
    }

    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    public function getAvg(array $ids, VersionE $version): array
    {
        return $this->getEntById(
            $ids,
            $this->prefix . $version->value .'_'. QDE::AVG->value . ':'
        );
    }

    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    public function getMax(array $ids, VersionE $version): array
    {
        return $this->getEntById(
            $ids,
            $this->prefix . $version->value .'_'. QDE::MAX->value . ':'
        );
    }
    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    public function getMic(array $ids): array
    {
        return $this->getEntById($ids, $this->prefix . QDE::MIC->value . ':');
    }

    /**
     * @param array<int> $index
     *
     * @return array<int, ?string>
     */
    public function getMicInd(array $index): array
    {
        return $this->getEntById($index, $this->prefix . QDE::MIC_IND->value . ':');
    }
    /**
     * @param array<int> $ids
     *
     * @return array<int, string>
     */
    private function getEntById(array $ids, string $dbn): array
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
