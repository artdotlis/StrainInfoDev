<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view;

use straininfo\server\interfaces\mvvm\controller\ToViewIntC;
use straininfo\server\interfaces\mvvm\view\ToViewIntV;
use straininfo\server\mvvm\view\chan\QVChanAll;
use straininfo\server\mvvm\view\chan\QVChanArc;
use straininfo\server\mvvm\view\chan\QVChanCnt;
use straininfo\server\mvvm\view\chan\QVChanDat;
use straininfo\server\mvvm\view\chan\QVChanSeaCul;
use straininfo\server\mvvm\view\chan\QVChanSeaOpt;
use straininfo\server\mvvm\view\chan\QVChanSeaStr;
use straininfo\server\mvvm\view\chan\QVChanStat;

final class ToViewChanV implements ToViewIntV
{
    private readonly QVChanSeaCul $cul_sea;
    private readonly QVChanSeaStr $str_sea;
    private readonly QVChanAll $all;
    private readonly QVChanSeaOpt $sea_opt;
    private readonly QVChanStat $stat;
    private readonly QVChanDat $cul;
    private readonly QVChanDat $str;
    private readonly QVChanCnt $cnt;
    private readonly QVChanArc $arc;

    public function __construct(ToViewIntC $tvc)
    {
        $this->cul_sea = new QVChanSeaCul($tvc->getQCCulSea());
        $this->str_sea = new QVChanSeaStr($tvc->getQCStrSea());
        $this->all = new QVChanAll($tvc->getQCAll());
        $this->sea_opt = new QVChanSeaOpt($tvc->getQCOptSea());
        $this->stat = new QVChanStat($tvc->getQCStat());
        $this->cul = new QVChanDat($tvc->getQCCul());
        $this->str = new QVChanDat($tvc->getQCStr());
        $this->cnt = new QVChanCnt($tvc->getQCCnt());
        $this->arc = new QVChanArc($tvc->getQCArc());
    }

    // channels
    public function getQVChanCulSea(): QVChanSeaCul
    {
        return $this->cul_sea;
    }

    public function getQVChanStrSea(): QVChanSeaStr
    {
        return $this->str_sea;
    }

    public function getQVChanCul(): QVChanDat
    {
        return $this->cul;
    }

    public function getQVChanStr(): QVChanDat
    {
        return $this->str;
    }

    public function getQVChanCnt(): QVChanCnt
    {
        return $this->cnt;
    }

    public function getQVChanAll(): QVChanAll
    {
        return $this->all;
    }

    public function getQVChanStat(): QVChanStat
    {
        return $this->stat;
    }

    public function getQVChanArc(): QVChanArc
    {
        return $this->arc;
    }

    public function getQVChanOptSea(): QVChanSeaOpt
    {
        return $this->sea_opt;
    }
}
