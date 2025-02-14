<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\con;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAll;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArc;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCnt;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDat;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdCul;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdStr;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStat;

interface ToViewIntMCaGet
{
    public function getCaMCul(): CaMIntDat;

    public function getCaMStr(): CaMIntDat;

    public function getCaMCulSea(): CaMIntSeaIdCul;

    public function getCaMStrSea(): CaMIntSeaIdStr;

    public function getCaMArc(): CaMIntArc;

    public function getCaMAll(): CaMIntAll;

    public function getCaMStat(): CaMIntStat;

    public function getCaMCnt(): CaMIntCnt;

    public function setMaintenance(bool $maintenance): void;
}
