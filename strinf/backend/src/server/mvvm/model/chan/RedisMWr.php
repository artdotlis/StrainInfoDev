<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan;

use straininfo\server\exceptions\init_phase\KnownMaintainExc;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class RedisMWr
{
    /**
     * @readonly
     *
     * @var callable(): \Redis|null $dbc */
    protected $dbc;
    private bool $maintenance;
    private bool $maintain;
    /** @param callable(): \Redis|null $dbc */
    public function __construct(?callable $dbc, bool $maintain)
    {
        $this->dbc = $dbc;
        $this->maintenance = is_null($dbc);
        $this->maintain = $maintain;
    }

    public function setMaintenance(bool $maintenance): void
    {
        $this->maintenance = $maintenance;
    }

    public function isMaintenanceMode(): bool
    {
        return $this->maintenance;
    }

    protected function getDBC(): \Redis
    {
        if (is_null($this->dbc)) {
            throw new KnownMaintainExc(
                'Redis was not set properly',
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
        return ($this->dbc)();
    }

    protected function checkMaintenanceMode(): void
    {
        $this->getDBC();
        if ($this->maintain && $this->isMaintenanceMode()) {
            throw new KnownMaintainExc(
                'Called channel during maintenance!',
                LogLevE::ERROR,
                KEAct::WARN
            );
        }
    }
}
