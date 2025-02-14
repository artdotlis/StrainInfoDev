<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view;

use straininfo\server\interfaces\mvvm\view\chan\QVIntAll;
use straininfo\server\interfaces\mvvm\view\chan\QVIntArc;
use straininfo\server\interfaces\mvvm\view\chan\QVIntCnt;
use straininfo\server\interfaces\mvvm\view\chan\QVIntDat;
use straininfo\server\interfaces\mvvm\view\chan\QVIntOptSea;
use straininfo\server\interfaces\mvvm\view\chan\QVIntSeaIdCul;
use straininfo\server\interfaces\mvvm\view\chan\QVIntSeaIdStr;
use straininfo\server\interfaces\mvvm\view\chan\QVIntStat;

interface ToViewIntV
{
    public function getQVChanCnt(): QVIntCnt;

    public function getQVChanCulSea(): QVIntSeaIdCul;

    public function getQVChanStrSea(): QVIntSeaIdStr;

    public function getQVChanCul(): QVIntDat;

    public function getQVChanStr(): QVIntDat;

    public function getQVChanArc(): QVIntArc;

    public function getQVChanAll(): QVIntAll;

    public function getQVChanStat(): QVIntStat;

    public function getQVChanOptSea(): QVIntOptSea;
}
