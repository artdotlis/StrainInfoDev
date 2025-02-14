<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\cache;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMCnt;
use straininfo\server\mvvm\view_model\chan\cnt\cache\CaVMChanArc;
use straininfo\server\mvvm\view_model\chan\cnt\cache\CaVMChanCul;
use straininfo\server\mvvm\view_model\chan\cnt\cache\CaVMChanDes;
use straininfo\server\mvvm\view_model\chan\cnt\cache\CaVMChanSpe;
use straininfo\server\mvvm\view_model\chan\cnt\cache\CaVMChanStr;
use straininfo\server\mvvm\view_model\chan\cnt\cache\CaVMChanTCul;
use straininfo\server\mvvm\view_model\chan\cnt\cache\CaVMChanTStr;

/**
 * @phpstan-type CaVMIntCnt \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntCnt
 *
 * @implements ToViewIntVMCnt<CaVMIntCnt>
 */
final class ChanVMCntCa implements ToViewIntVMCnt
{
    private readonly CaVMChanCul $cul;
    private readonly CaVMChanSpe $spe;
    private readonly CaVMChanStr $str;
    private readonly CaVMChanArc $arc;
    private readonly CaVMChanTStr $t_str;
    private readonly CaVMChanTCul $t_cul;
    private readonly CaVMChanDes $des;

    public function __construct(
        ToViewIntMCaGet $get,
        ToViewIntMCaSet $set,
        string $chm,
        string $chv
    ) {
        $this->cul = new CaVMChanCul($get->getCaMCnt(), $set->getCaMCnt(), $chm, $chv);
        $this->spe = new CaVMChanSpe($get->getCaMCnt(), $set->getCaMCnt(), $chm, $chv);
        $this->str = new CaVMChanStr($get->getCaMCnt(), $set->getCaMCnt(), $chm, $chv);
        $this->t_str = new CaVMChanTStr($get->getCaMCnt(), $set->getCaMCnt(), $chm, $chv);
        $this->t_cul = new CaVMChanTCul($get->getCaMCnt(), $set->getCaMCnt(), $chm, $chv);
        $this->des = new CaVMChanDes($get->getCaMCnt(), $set->getCaMCnt(), $chm, $chv);
        $this->arc = new CaVMChanArc($get->getCaMCnt(), $set->getCaMCnt(), $chm, $chv);
    }

    public function getVMCul(): CaVMChanCul
    {
        return $this->cul;
    }

    public function getVMSpe(): CaVMChanSpe
    {
        return $this->spe;
    }

    public function getVMStr(): CaVMChanStr
    {
        return $this->str;
    }

    public function getVMArc(): CaVMChanArc
    {
        return $this->arc;
    }

    public function getVMTStr(): CaVMChanTStr
    {
        return $this->t_str;
    }

    public function getVMTCul(): CaVMChanTCul
    {
        return $this->t_cul;
    }

    public function getVMDes(): CaVMChanDes
    {
        return $this->des;
    }
}
