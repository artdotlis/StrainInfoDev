<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\con;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMInd;
use straininfo\server\interfaces\mvvm\model\chan\index\IMIntEnt;
use straininfo\server\interfaces\mvvm\model\IndexIntM;

final class ToViewMInSea implements ToViewIntMInd
{
    /** @var IndexIntM<IMIntEnt> */
    private readonly IndexIntM $dbc;

    /** @param IndexIntM<IMIntEnt> $dbc */
    public function __construct(IndexIntM $dbc)
    {
        $this->dbc = $dbc;
    }

    public function getIndMEnt(): IMIntEnt
    {
        return $this->dbc->getIMEnt();
    }

    public function setMaintenance(bool $maintenance): void
    {
        $this->getIndMEnt()->setMaintenance($maintenance);
    }
}
