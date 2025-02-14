<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAll;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAllSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArc;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArcSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCnt;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCntSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDat;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDatSet;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdCul;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetCul;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetStr;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdStr;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStat;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStatSet;
use straininfo\server\shared\mvvm\model\CacheArgs;

interface CacheIntM
{
    public function getCaStr(): CaMIntDat;

    public function getCaStrSet(): CaMIntDatSet;

    public function getCaCul(): CaMIntDat;

    public function getCaCulSet(): CaMIntDatSet;

    public function getCaCulSea(): CaMIntSeaIdCul;

    public function getCaCulSeaSet(): CaMIntSeaIdSetCul;

    public function getCaStrSea(): CaMIntSeaIdStr;

    public function getCaStrSeaSet(): CaMIntSeaIdSetStr;

    public function getCaCnt(): CaMIntCnt;

    public function getCaCntSet(): CaMIntCntSet;

    public function getCaAll(): CaMIntAll;

    public function getCaAllSet(): CaMIntAllSet;

    public function getCaArc(): CaMIntArc;

    public function getCaArcSet(): CaMIntArcSet;

    public function getCaStat(): CaMIntStat;

    public function getCaStatSet(): CaMIntStatSet;

    public function getCaConf(): CacheArgs;
}
