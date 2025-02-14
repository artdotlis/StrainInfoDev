<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan;

interface MainChannel
{
    public function isMaintenanceMode(): bool;

    public function setMaintenance(bool $maintenance): void;
}
