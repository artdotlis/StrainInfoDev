<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan;

use straininfo\server\exceptions\init_phase\KnownMaintainExc;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class PdoMWr
{
    protected readonly ?\PDO $dbc;
    private bool $maintenance;
    private bool $maintain;

    public function __construct(?\PDO $dbc, bool $maintain)
    {
        $this->dbc = $dbc;
        $this->maintain = $maintain;
        $this->maintenance = is_null($dbc);
    }

    public function setMaintenance(bool $maintenance): void
    {
        $this->maintenance = $maintenance;
    }

    public function isMaintenanceMode(): bool
    {
        return $this->maintenance;
    }

    protected function prepDefSta(string $sql): \PDOStatement
    {
        $sta = $this->getDBC()->prepare($sql);
        $sta->setFetchMode(\PDO::FETCH_ASSOC);
        return $sta;
    }

    protected function getDBC(): \PDO
    {
        if (is_null($this->dbc)) {
            throw new KnownMaintainExc(
                'Database was not set properly',
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
