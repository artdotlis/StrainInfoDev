<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\con;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntAll;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntArc;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntCnt;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntDat;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaIdCul;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaIdStr;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntStat;

/**
 * @template TC
 * @template TS
 */
interface ToViewIntMQ
{
    /** @return QMIntDat<TC> */
    public function getQMCul(): QMIntDat;

    /** @return QMIntDat<TS> */
    public function getQMStr(): QMIntDat;

    public function getQMCulSea(): QMIntSeaIdCul;

    public function getQMStrSea(): QMIntSeaIdStr;

    public function getQMArc(): QMIntArc;

    public function getQMAll(): QMIntAll;

    public function getQMStat(): QMIntStat;

    public function getQMCnt(): QMIntCnt;

    public function setMaintenance(bool $maintenance): void;
}
