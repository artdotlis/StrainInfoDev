<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\con;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntAll;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntArc;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntCnt;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntDat;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaIdCul;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaIdStr;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntStat;
use straininfo\server\interfaces\mvvm\model\DBIntM;

/**
 * @implements ToViewIntMQ<array<string, object>, array<string, object>>
 */
final class ToViewMQ implements ToViewIntMQ
{
    /** @var DBIntM<array<string, object>, array<string, object>> */
    private readonly DBIntM $dbc;

    /**
     * @param DBIntM<array<string, object>, array<string, object>> $dbc
     */
    public function __construct(DBIntM $dbc)
    {
        $this->dbc = $dbc;
    }

    /** @return QMIntDat<array<string, object>>*/
    public function getQMCul(): QMIntDat
    {
        return $this->dbc->getQDBCul();
    }

    /** @return QMIntDat<array<string, object>>*/
    public function getQMStr(): QMIntDat
    {
        return $this->dbc->getQDBStr();
    }

    public function getQMArc(): QMIntArc
    {
        return $this->dbc->getQDBArc();
    }

    public function getQMCulSea(): QMIntSeaIdCul
    {
        return $this->dbc->getQDBCulSea();
    }

    public function getQMStrSea(): QMIntSeaIdStr
    {
        return $this->dbc->getQDBStrSea();
    }

    public function getQMAll(): QMIntAll
    {
        return $this->dbc->getQDBAll();
    }

    public function getQMCnt(): QMIntCnt
    {
        return $this->dbc->getQDBCnt();
    }

    public function getQMStat(): QMIntStat
    {
        return $this->dbc->getQDBStat();
    }

    public function setMaintenance(bool $maintenance): void
    {
        $this->getQMCnt()->setMaintenance($maintenance);
        $this->getQMCulSea()->setMaintenance($maintenance);
        $this->getQMStrSea()->setMaintenance($maintenance);
        $this->getQMCul()->setMaintenance($maintenance);
        $this->getQMAll()->setMaintenance($maintenance);
        $this->getQMStat()->setMaintenance($maintenance);
        $this->getQMArc()->setMaintenance($maintenance);
    }
}
