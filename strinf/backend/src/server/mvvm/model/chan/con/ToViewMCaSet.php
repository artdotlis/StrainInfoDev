<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\con;

use straininfo\server\interfaces\mvvm\model\CacheIntM;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAllSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArcSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCntSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDatSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetCul;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetStr;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStatSet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;

final class ToViewMCaSet implements ToViewIntMCaSet
{
    private readonly CacheIntM $dbc;

    public function __construct(CacheIntM $dbc)
    {
        $this->dbc = $dbc;
    }

    public function getCaMCnt(): CaMIntCntSet
    {
        return $this->dbc->getCaCntSet();
    }

    public function getCaMCul(): CaMIntDatSet
    {
        return $this->dbc->getCaCulSet();
    }

    public function getCaMStr(): CaMIntDatSet
    {
        return $this->dbc->getCaStrSet();
    }

    public function getCaMArc(): CaMIntArcSet
    {
        return $this->dbc->getCaArcSet();
    }

    public function getCaMCulSea(): CaMIntSeaIdSetCul
    {
        return $this->dbc->getCaCulSeaSet();
    }

    public function getCaMStrSea(): CaMIntSeaIdSetStr
    {
        return $this->dbc->getCaStrSeaSet();
    }

    public function getCaMAll(): CaMIntAllSet
    {
        return $this->dbc->getCaAllSet();
    }

    public function getCaMStat(): CaMIntStatSet
    {
        return $this->dbc->getCaStatSet();
    }

    public function setMaintenance(bool $maintenance): void
    {
        $this->getCaMCnt()->setMaintenance($maintenance);
        $this->getCaMCul()->setMaintenance($maintenance);
        $this->getCaMStr()->setMaintenance($maintenance);
        $this->getCaMCulSea()->setMaintenance($maintenance);
        $this->getCaMStrSea()->setMaintenance($maintenance);
        $this->getCaMAll()->setMaintenance($maintenance);
        $this->getCaMStat()->setMaintenance($maintenance);
        $this->getCaMArc()->setMaintenance($maintenance);
    }
}
