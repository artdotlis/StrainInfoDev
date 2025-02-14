<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\con;

use straininfo\server\interfaces\mvvm\model\chan\index\IMIntEnt;

interface ToViewIntMInd
{
    public function getIndMEnt(): IMIntEnt;

    public function setMaintenance(bool $maintenance): void;
}
