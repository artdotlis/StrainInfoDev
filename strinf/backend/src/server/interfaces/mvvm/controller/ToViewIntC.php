<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntAll;
use straininfo\server\interfaces\mvvm\controller\chan\QCIntArc;
use straininfo\server\interfaces\mvvm\controller\chan\QCIntCnt;
use straininfo\server\interfaces\mvvm\controller\chan\QCIntDat;
use straininfo\server\interfaces\mvvm\controller\chan\QCIntOptSea;
use straininfo\server\interfaces\mvvm\controller\chan\QCIntSeaCulId;
use straininfo\server\interfaces\mvvm\controller\chan\QCIntSeaStrId;
use straininfo\server\interfaces\mvvm\controller\chan\QCIntStat;

interface ToViewIntC
{
    public function getQCCul(): QCIntDat;

    public function getQCStr(): QCIntDat;

    public function getQCCulSea(): QCIntSeaCulId;

    public function getQCStrSea(): QCIntSeaStrId;

    public function getQCAll(): QCIntAll;

    public function getQCStat(): QCIntStat;

    public function getQCOptSea(): QCIntOptSea;

    public function getQCArc(): QCIntArc;

    public function getQCCnt(): QCIntCnt;
}
