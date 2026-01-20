<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\controller;

use straininfo\server\interfaces\mvvm\controller\ToViewIntC;
use straininfo\server\interfaces\mvvm\view_model\VMIntCtrl;
use straininfo\server\mvvm\controller\chan\QCChanAll;
use straininfo\server\mvvm\controller\chan\QCChanArc;
use straininfo\server\mvvm\controller\chan\QCChanCnt;
use straininfo\server\mvvm\controller\chan\QCChanDat;
use straininfo\server\mvvm\controller\chan\QCChanSeaCul;
use straininfo\server\mvvm\controller\chan\QCChanSeaOpt;
use straininfo\server\mvvm\controller\chan\QCChanSeaStr;
use straininfo\server\mvvm\controller\chan\QCChanStat;
use straininfo\server\mvvm\controller\const\ConCtrlAll;
use straininfo\server\mvvm\controller\const\ConCtrlArc;
use straininfo\server\mvvm\controller\const\ConCtrlCnt;
use straininfo\server\mvvm\controller\const\ConCtrlDat;
use straininfo\server\mvvm\controller\const\ConCtrlSeaCul;
use straininfo\server\mvvm\controller\const\ConCtrlSeaOpt;
use straininfo\server\mvvm\controller\const\ConCtrlSeaStr;
use straininfo\server\mvvm\controller\const\ConCtrlStat;

/**
 * @phpstan-type ParCul \straininfo\server\shared\mvvm\view_model\data\ParCul
 * @phpstan-type ParStr \straininfo\server\shared\mvvm\view_model\data\ParStr
 */
final class ToViewChanC implements ToViewIntC
{
    /** @var QCChanDat<ParCul> */
    private readonly QCChanDat $q_cul;

    /** @var QCChanDat<ParStr> */
    private readonly QCChanDat $q_str;
    private readonly QCChanArc $q_arc;
    private readonly QCChanSeaCul $q_sea_cul;
    private readonly QCChanSeaStr $q_sea_str;
    private readonly QCChanCnt $q_cnt;
    private readonly QCChanAll $q_all;
    private readonly QCChanStat $q_stat;
    private readonly QCChanSeaOpt $q_sea_opt;

    /** @param VMIntCtrl<ParCul, ParStr, int> $mvc */
    public function __construct(VMIntCtrl $mvc)
    {
        $this->q_cul = self::createCul($mvc);
        $this->q_str = self::createStr($mvc);
        $this->q_sea_cul = self::createCulSea($mvc);
        $this->q_sea_str = self::createStrSea($mvc);
        $this->q_cnt = self::createCnt($mvc);
        $this->q_all = self::createAll($mvc);
        $this->q_stat = self::createStat($mvc);
        $this->q_arc = self::createArc($mvc);
        $this->q_sea_opt = self::createSeaOpt($mvc);
    }
    // channels
    public function getQCCulSea(): QCChanSeaCul
    {
        return $this->q_sea_cul;
    }

    public function getQCStrSea(): QCChanSeaStr
    {
        return $this->q_sea_str;
    }

    public function getQCAll(): QCChanAll
    {
        return $this->q_all;
    }

    public function getQCStat(): QCChanStat
    {
        return $this->q_stat;
    }

    public function getQCOptSea(): QCChanSeaOpt
    {
        return $this->q_sea_opt;
    }

    public function getQCArc(): QCChanArc
    {
        return $this->q_arc;
    }

    /** @return QCChanDat<ParCul> */
    public function getQCCul(): QCChanDat
    {
        return $this->q_cul;
    }

    /** @return QCChanDat<ParStr> */
    public function getQCStr(): QCChanDat
    {
        return $this->q_str;
    }

    public function getQCCnt(): QCChanCnt
    {
        return $this->q_cnt;
    }

    // factory
    /**
     * @param VMIntCtrl<ParCul, ParStr, int> $mvc
     *
     * @return QCChanDat<ParCul>
     */
    private static function createCul(VMIntCtrl $mvc): QCChanDat
    {
        $cul_q = $mvc->getToViewVerCon()->getToViewQChanCul();
        $cul_b = $mvc->getToViewVerCon()->getToViewCaChanCul();
        $con_q = new ConCtrlDat(
            min: $cul_q->getVMMin(),
            avg: $cul_q->getVMAvg(),
            max: $cul_q->getVMMax()
        );
        /** @var ConCtrlDat<null, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat>  $con_b */
        $con_b = new ConCtrlDat(
            min: $cul_b->getVMMin(),
            avg: $cul_b->getVMAvg(),
            max: $cul_b->getVMMax()
        );
        return new QCChanDat($con_q, $con_b);
    }

    /**
     * @param VMIntCtrl<ParCul, ParStr, int> $mvc
     *
     * @return QCChanDat<ParStr>
     */
    private static function createStr(VMIntCtrl $mvc): QCChanDat
    {
        $str_q = $mvc->getToViewVerCon()->getToViewQChanStr();
        $str_b = $mvc->getToViewVerCon()->getToViewCaChanStr();
        $con_q = new ConCtrlDat(
            min: $str_q->getVMMin(),
            avg: $str_q->getVMAvg(),
            max: $str_q->getVMMax()
        );
        /** @var ConCtrlDat<null, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat>  $con_b */
        $con_b = new ConCtrlDat(
            min: $str_b->getVMMin(),
            avg: $str_b->getVMAvg(),
            max: $str_b->getVMMax()
        );
        return new QCChanDat($con_q, $con_b);
    }

    /** @param VMIntCtrl<ParCul, ParStr, int> $mvc */
    private static function createCnt(VMIntCtrl $mvc): QCChanCnt
    {
        $cnt_q = $mvc->getToViewVerCon()->getToViewQChanCnt();
        $cnt_b = $mvc->getToViewVerCon()->getToViewCaChanCnt();
        $con_q = new ConCtrlCnt(
            spe: $cnt_q->getVMSpe(),
            cul: $cnt_q->getVMCul(),
            str: $cnt_q->getVMStr(),
            t_str: $cnt_q->getVMTStr(),
            arc: $cnt_q->getVMArc(),
            t_cul: $cnt_q->getVMTCul(),
            des: $cnt_q->getVMDes()
        );
        $con_b = new ConCtrlCnt(
            spe: $cnt_b->getVMSpe(),
            cul: $cnt_b->getVMCul(),
            str: $cnt_b->getVMStr(),
            t_str: $cnt_b->getVMTStr(),
            arc: $cnt_b->getVMArc(),
            t_cul: $cnt_b->getVMTCul(),
            des: $cnt_b->getVMDes()
        );
        return new QCChanCnt($con_q, $con_b);
    }

    /** @param VMIntCtrl<ParCul, ParStr, int> $mvc */
    private static function createCulSea(VMIntCtrl $mvc): QCChanSeaCul
    {
        $sea_q = $mvc->getToViewVerCon()->getToViewQChanCulSea();
        $sea_b = $mvc->getToViewVerCon()->getToViewCaChanCulSea();
        $con_q = new ConCtrlSeaCul(
            tax_name: $sea_q->getVMTaxName(),
            str: $sea_q->getVMStr(),
            str_no: $sea_q->getVMStrNo(),
            str_des: $sea_q->getVMStrDes(),
            seq: $sea_q->getVMSeq(),
            brc: $sea_q->getVMBrc()
        );
        $con_b = new ConCtrlSeaCul(
            tax_name: $sea_b->getVMTaxName(),
            str: $sea_b->getVMStr(),
            str_no: $sea_b->getVMStrNo(),
            str_des: $sea_b->getVMStrDes(),
            seq: $sea_b->getVMSeq(),
            brc: $sea_b->getVMBrc()
        );
        return new QCChanSeaCul($con_q, $con_b);
    }

    /** @param VMIntCtrl<ParCul, ParStr, int> $mvc */
    private static function createStrSea(VMIntCtrl $mvc): QCChanSeaStr
    {
        $sea_q = $mvc->getToViewVerCon()->getToViewQChanStrSea();
        $sea_b = $mvc->getToViewVerCon()->getToViewCaChanStrSea();
        $con_q = new ConCtrlSeaStr(
            tax_name: $sea_q->getVMTaxName(),
            str_no: $sea_q->getVMStrNo(),
            str_des: $sea_q->getVMStrDes(),
            seq: $sea_q->getVMSeq(),
            brc: $sea_q->getVMBrc(),
            cul: $sea_q->getVMCul()
        );
        $con_b = new ConCtrlSeaStr(
            tax_name: $sea_b->getVMTaxName(),
            str_no: $sea_b->getVMStrNo(),
            str_des: $sea_b->getVMStrDes(),
            seq: $sea_b->getVMSeq(),
            brc: $sea_b->getVMBrc(),
            cul: $sea_b->getVMCul()
        );
        return new QCChanSeaStr($con_q, $con_b);
    }

    /** @param VMIntCtrl<ParCul, ParStr, int> $mvc */
    private static function createAll(VMIntCtrl $mvc): QCChanAll
    {
        $all_q = $mvc->getToViewSerCon()->getToViewQChanAll();
        $all_b = $mvc->getToViewSerCon()->getToViewCaChanAll();
        $con_q = new ConCtrlAll(
            t_cul: $all_q->getVMTCul(),
            cul: $all_q->getVMCul(),
            str: $all_q->getVMStr(),
            t_str: $all_q->getVMTStr()
        );
        $con_b = new ConCtrlAll(
            t_cul: $all_b->getVMTCul(),
            cul: $all_b->getVMCul(),
            str: $all_b->getVMStr(),
            t_str: $all_b->getVMTStr()
        );
        return new QCChanAll($con_q, $con_b);
    }

    /** @param VMIntCtrl<ParCul, ParStr, int> $mvc */
    private static function createStat(VMIntCtrl $mvc): QCChanStat
    {
        $all_q = $mvc->getToViewSerCon()->getToViewQChanStat();
        $all_b = $mvc->getToViewSerCon()->getToViewCaChanStat();
        $con_q = new ConCtrlStat(
            cul_per_str: $all_q->getVMCulPStrCnt()
        );
        $con_b = new ConCtrlStat(
            cul_per_str: $all_b->getVMCulPStrCnt()
        );
        return new QCChanStat($con_q, $con_b);
    }

    /** @param VMIntCtrl<ParCul, ParStr, int> $mvc */
    private static function createSeaOpt(VMIntCtrl $mvc): QCChanSeaOpt
    {
        $sea_opt = $mvc->getToViewSerCon()->getToViewOptSeaChanSea();
        $con_q = new ConCtrlSeaOpt(
            index: $sea_opt->getVMIndSea(),
            sea_opt: $sea_opt->getVMOptSea()
        );
        $all_q = $mvc->getToViewSerCon()->getToViewQChanAll();
        $all_b = $mvc->getToViewSerCon()->getToViewCaChanAll();
        $str_q = $mvc->getToViewVerCon()->getToViewQChanStr();
        $str_b = $mvc->getToViewVerCon()->getToViewCaChanStr();

        return new QCChanSeaOpt(
            $con_q,
            $str_q->getVMMin(),
            $str_b->getVMMin(),
            $sea_opt->getVMSeaMic(),
            $sea_opt->getVMSeaMicInd(),
            $all_q->getVMStr(),
            $all_b->getVMStr()
        );
    }

    /** @param VMIntCtrl<ParCul, ParStr, int> $mvc */
    private static function createArc(VMIntCtrl $mvc): QCChanArc
    {
        $all_q = $mvc->getToViewSerCon()->getToViewQChanArc();
        $all_b = $mvc->getToViewSerCon()->getToViewCaChanArc();
        $con_q = new ConCtrlArc(arc: $all_q->getVMArc());
        $con_b = new ConCtrlArc(arc: $all_b->getVMArc());
        return new QCChanArc($con_q, $con_b);
    }
}
