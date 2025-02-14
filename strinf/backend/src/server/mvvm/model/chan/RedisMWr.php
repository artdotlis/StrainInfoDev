<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan;

use Predis;
use straininfo\server\exceptions\init_phase\KnownMaintainExc;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class RedisMWr
{
    protected readonly ?Predis\Client $dbc;
    private bool $maintenance;
    private bool $maintain;

    public function __construct(?Predis\Client $dbc, bool $maintain)
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

    protected function getDBC(): Predis\Client
    {
        if (is_null($this->dbc)) {
            throw new KnownMaintainExc(
                'Redis was not set properly',
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
        return $this->dbc;
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
