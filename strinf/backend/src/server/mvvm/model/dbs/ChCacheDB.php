<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\dbs;

use Predis;
use straininfo\server\interfaces\mvvm\model\CacheIntM;
use straininfo\server\mvvm\model\chan\cache\CaRAll;
use straininfo\server\mvvm\model\chan\cache\CaRAllSet;
use straininfo\server\mvvm\model\chan\cache\CaRArc;
use straininfo\server\mvvm\model\chan\cache\CaRArcSet;
use straininfo\server\mvvm\model\chan\cache\CaRCnt;
use straininfo\server\mvvm\model\chan\cache\CaRCntSet;
use straininfo\server\mvvm\model\chan\cache\CaRDat;
use straininfo\server\mvvm\model\chan\cache\CaRDatSet;
use straininfo\server\mvvm\model\chan\cache\CaRSeaGetCul;
use straininfo\server\mvvm\model\chan\cache\CaRSeaGetStr;
use straininfo\server\mvvm\model\chan\cache\CaRSeaSetCul;
use straininfo\server\mvvm\model\chan\cache\CaRSeaSetStr;
use straininfo\server\mvvm\model\chan\cache\CaRStat;
use straininfo\server\mvvm\model\chan\cache\CaRStatSet;
use straininfo\server\mvvm\model\dbs\con\DBCR;
use straininfo\server\shared\mvvm\model\CacheArgs;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class ChCacheDB extends DBCR implements CacheIntM
{
    // immutable
    private readonly CacheArgs $db_conf;

    // mutable
    private CaRCnt $b_cnt;
    private CaRCntSet $b_cnt_set;

    private CaRDat $b_cul;
    private CaRDatSet $b_cul_set;

    private CaRDat $b_str;
    private CaRDatSet $b_str_set;

    private CaRSeaGetCul $b_sea_cul;
    private CaRSeaSetCul $b_sea_cul_set;

    private CaRSeaGetStr $b_sea_str;
    private CaRSeaSetStr $b_sea_str_set;

    private CaRAll $b_all;
    private CaRAllSet $b_all_set;

    private CaRArc $b_arc;
    private CaRArcSet $b_arc_set;

    private CaRStat $b_dis;
    private CaRStatSet $b_dis_set;

    public function __construct(CacheArgs $args)
    {
        $this->db_conf = $args;
        parent::__construct($args);
    }

    public function getCaCnt(): CaRCnt
    {
        return $this->b_cnt;
    }

    public function getCaCntSet(): CaRCntSet
    {
        return $this->b_cnt_set;
    }

    public function getCaAll(): CaRAll
    {
        return $this->b_all;
    }

    public function getCaAllSet(): CaRAllSet
    {
        return $this->b_all_set;
    }

    public function getCaStat(): CaRStat
    {
        return $this->b_dis;
    }

    public function getCaStatSet(): CaRStatSet
    {
        return $this->b_dis_set;
    }

    public function getCaCul(): CaRDat
    {
        return $this->b_cul;
    }

    public function getCaCulSet(): CaRDatSet
    {
        return $this->b_cul_set;
    }

    public function getCaStr(): CaRDat
    {
        return $this->b_str;
    }

    public function getCaStrSet(): CaRDatSet
    {
        return $this->b_str_set;
    }

    public function getCaCulSea(): CaRSeaGetCul
    {
        return $this->b_sea_cul;
    }

    public function getCaCulSeaSet(): CaRSeaSetCul
    {
        return $this->b_sea_cul_set;
    }

    public function getCaStrSea(): CaRSeaGetStr
    {
        return $this->b_sea_str;
    }

    public function getCaStrSeaSet(): CaRSeaSetStr
    {
        return $this->b_sea_str_set;
    }

    public function getCaArc(): CaRArc
    {
        return $this->b_arc;
    }

    public function getCaArcSet(): CaRArcSet
    {
        return $this->b_arc_set;
    }

    public function getCaConf(): CacheArgs
    {
        return $this->db_conf;
    }

    protected function afterConnect(?Predis\Client $redis): void
    {
        $ex_h = $this->db_conf->getExH();
        $tmp_h = $this->db_conf->getTmpH();
        $lim = $this->db_conf->getLimit();
        $this->b_cnt = new CaRCnt($redis);
        $this->b_cnt_set = new CaRCntSet($redis);
        $this->b_cul = new CaRDat($redis, RedisStE::P_CUL->value);
        $this->b_cul_set = new CaRDatSet($redis, $ex_h, $lim, RedisStE::P_CUL->value);
        $this->b_str = new CaRDat($redis, RedisStE::P_STR->value);
        $this->b_str_set = new CaRDatSet($redis, $ex_h, $lim, RedisStE::P_STR->value);
        $this->b_sea_cul = new CaRSeaGetCul($redis);
        $this->b_sea_cul_set = new CaRSeaSetCul($redis, $ex_h, $tmp_h, $lim);
        $this->b_sea_str = new CaRSeaGetStr($redis);
        $this->b_sea_str_set = new CaRSeaSetStr($redis, $ex_h, $tmp_h, $lim);
        $this->b_arc = new CaRArc($redis);
        $this->b_arc_set = new CaRArcSet($redis, $tmp_h, $lim);
        $this->b_all = new CaRAll($redis);
        $this->b_all_set = new CaRAllSet($redis, $ex_h, $lim);
        $this->b_dis = new CaRStat($redis);
        $this->b_dis_set = new CaRStatSet($redis);
    }
}
