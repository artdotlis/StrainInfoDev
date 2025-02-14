<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\dbs;

use straininfo\server\interfaces\mvvm\model\DBIntM;
use straininfo\server\mvvm\model\chan\sia\QPAll;
use straininfo\server\mvvm\model\chan\sia\QPArc;
use straininfo\server\mvvm\model\chan\sia\QPCnt;
use straininfo\server\mvvm\model\chan\sia\QPCul;
use straininfo\server\mvvm\model\chan\sia\QPCulSea;
use straininfo\server\mvvm\model\chan\sia\QPStat;
use straininfo\server\mvvm\model\chan\sia\QPStr;
use straininfo\server\mvvm\model\chan\sia\QPStrSea;
use straininfo\server\mvvm\model\dbs\con\DBCM;
use straininfo\server\shared\mvvm\model\DBArgs;

/**
 * @template TC
 * @template TS
 *
 * @implements DBIntM<TC,TS>
 */
final class ChMainDB extends DBCM implements DBIntM
{
    private readonly DBArgs $db_conf;

    private QPCul $q_cul;
    private QPStr $q_str;
    private QPCulSea $q_sea_cul;
    private QPStrSea $q_sea_str;
    private QPCnt $q_cnt;
    private QPAll $q_all;
    private QPStat $q_dis;
    private QPArc $q_arc;

    public function __construct(DBArgs $args)
    {
        $this->db_conf = $args;
        parent::__construct($args);
    }

    public function getQDBCul(): QPCul
    {
        return $this->q_cul;
    }

    public function getQDBStr(): QPStr
    {
        return $this->q_str;
    }

    public function getQDBArc(): QPArc
    {
        return $this->q_arc;
    }

    public function getQDBAll(): QPAll
    {
        return $this->q_all;
    }

    public function getQDBStat(): QPStat
    {
        return $this->q_dis;
    }

    public function getQDBCulSea(): QPCulSea
    {
        return $this->q_sea_cul;
    }

    public function getQDBStrSea(): QPStrSea
    {
        return $this->q_sea_str;
    }

    public function getQDBCnt(): QPCnt
    {
        return $this->q_cnt;
    }

    public function getQDBConf(): DBArgs
    {
        return $this->db_conf;
    }

    protected function afterConnect(?\PDO $pdo): void
    {
        $this->q_cul = new QPCul($pdo);
        $this->q_str = new QPStr($pdo);
        $this->q_sea_cul = new QPCulSea($pdo);
        $this->q_sea_str = new QPStrSea($pdo);
        $this->q_cnt = new QPCnt($pdo);
        $this->q_all = new QPAll($pdo);
        $this->q_dis = new QPStat($pdo);
        $this->q_arc = new QPArc($pdo);
    }
}
