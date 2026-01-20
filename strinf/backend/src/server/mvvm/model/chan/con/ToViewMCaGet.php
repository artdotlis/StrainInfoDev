<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\con;

use straininfo\server\interfaces\mvvm\model\CacheIntM;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAll;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArc;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCnt;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDat;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdCul;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdStr;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStat;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;

final class ToViewMCaGet implements ToViewIntMCaGet
{
    private readonly CacheIntM $dbc;

    public function __construct(CacheIntM $dbc)
    {
        $this->dbc = $dbc;
    }

    public function getCaMCnt(): CaMIntCnt
    {
        return $this->dbc->getCaCnt();
    }

    public function getCaMArc(): CaMIntArc
    {
        return $this->dbc->getCaArc();
    }

    public function getCaMCul(): CaMIntDat
    {
        return $this->dbc->getCaCul();
    }

    public function getCaMStr(): CaMIntDat
    {
        return $this->dbc->getCaStr();
    }

    public function getCaMCulSea(): CaMIntSeaIdCul
    {
        return $this->dbc->getCaCulSea();
    }

    public function getCaMStrSea(): CaMIntSeaIdStr
    {
        return $this->dbc->getCaStrSea();
    }

    public function getCaMAll(): CaMIntAll
    {
        return $this->dbc->getCaAll();
    }

    public function getCaMStat(): CaMIntStat
    {
        return $this->dbc->getCaStat();
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
