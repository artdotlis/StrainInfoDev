<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDatSet;
use straininfo\server\mvvm\model\chan\RedisMWr;
use straininfo\server\shared\mvvm\view\api\VersionE;
use straininfo\server\shared\mvvm\view_model\data\QDE;

final class CaRDatSet extends RedisMWr implements CaMIntDatSet
{
    private readonly int $ex_s;
    private readonly int $limit;
    private readonly string $prefix;

    /** @param callable(): \Redis|null $dbc */
    public function __construct(
        ?callable $dbc,
        int $ex_h,
        int $limit,
        string $prefix
    ) {
        $this->prefix = $prefix;
        $this->ex_s = 3_600 * $ex_h;
        $this->limit = $limit;
        parent::__construct($dbc, true);
    }

    /** @param array<int, string> $data */
    public function setMin(array $data, VersionE $version, bool $perm): void
    {
        $this->setEntById(
            $data,
            $this->prefix .  $version->value .'_'.QDE::MIN->value . ':',
            $perm
        );
    }

    /** @param array<int, string> $data */
    public function setAvg(array $data, VersionE $version, bool $perm): void
    {
        $this->setEntById(
            $data,
            $this->prefix . $version->value .'_'. QDE::AVG->value . ':',
            $perm
        );
    }

    /** @param array<int, string> $data */
    public function setMax(array $data, VersionE $version, bool $perm): void
    {
        $this->setEntById(
            $data,
            $this->prefix . $version->value .'_'. QDE::MAX->value . ':',
            $perm
        );
    }

    /** @param array<int, string> $data */
    public function setMic(array $data): void
    {
        $this->setEntById($data, $this->prefix . QDE::MIC->value . ':', false);
    }

    /** @param array<int, string> $data */
    public function setMicInd(array $data): void
    {
        $this->setEntById($data, $this->prefix . QDE::MIC_IND->value . ':', false);
    }

    /** @param array<int, string> $data */
    private function setEntById(array $data, string $dbn, bool $perm): void
    {
        $this->checkMaintenanceMode();
        if (count($data) < $this->limit) {
            $pipe = $this->getDBC()->pipeline();
            foreach ($data as $id => $json) {
                if ($perm) {
                    $pipe = $pipe->set($dbn . $id, $json);
                } else {
                    $pipe = $pipe->set($dbn . $id, $json, ['EX' => $this->ex_s]);
                }
            }
            $pipe->exec();
        }
    }
}
