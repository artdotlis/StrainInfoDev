<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\query;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMCnt;
use straininfo\server\mvvm\view_model\chan\cnt\query\QVMChanArc;
use straininfo\server\mvvm\view_model\chan\cnt\query\QVMChanCul;
use straininfo\server\mvvm\view_model\chan\cnt\query\QVMChanDes;
use straininfo\server\mvvm\view_model\chan\cnt\query\QVMChanSpe;
use straininfo\server\mvvm\view_model\chan\cnt\query\QVMChanStr;
use straininfo\server\mvvm\view_model\chan\cnt\query\QVMChanTCul;
use straininfo\server\mvvm\view_model\chan\cnt\query\QVMChanTStr;

/**
 * @phpstan-type QVMIntCnt \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntCnt
 *
 * @implements ToViewIntVMCnt<QVMIntCnt>
 */
final class ChanVMCntQ implements ToViewIntVMCnt
{
    private readonly QVMChanCul $cul;
    private readonly QVMChanSpe $spe;
    private readonly QVMChanStr $str;
    private readonly QVMChanArc $arc;
    private readonly QVMChanTStr $t_str;
    private readonly QVMChanTCul $t_cul;
    private readonly QVMChanDes $des;

    /**
     * @param ToViewIntMQ<array<string, object>, array<string, object>> $to_view
     */
    public function __construct(ToViewIntMQ $to_view, string $char_m, string $char_v)
    {
        $this->cul = new QVMChanCul($to_view->getQMCnt(), $char_m, $char_v);
        $this->spe = new QVMChanSpe($to_view->getQMCnt(), $char_m, $char_v);
        $this->str = new QVMChanStr($to_view->getQMCnt(), $char_m, $char_v);
        $this->arc = new QVMChanArc($to_view->getQMCnt(), $char_m, $char_v);
        $this->t_str = new QVMChanTStr($to_view->getQMCnt(), $char_m, $char_v);
        $this->t_cul = new QVMChanTCul($to_view->getQMCnt(), $char_m, $char_v);
        $this->des = new QVMChanDes($to_view->getQMCnt(), $char_m, $char_v);
    }

    public function getVMCul(): QVMChanCul
    {
        return $this->cul;
    }

    public function getVMSpe(): QVMChanSpe
    {
        return $this->spe;
    }

    public function getVMStr(): QVMChanStr
    {
        return $this->str;
    }

    public function getVMArc(): QVMChanArc
    {
        return $this->arc;
    }

    public function getVMTStr(): QVMChanTStr
    {
        return $this->t_str;
    }

    public function getVMTCul(): QVMChanTCul
    {
        return $this->t_cul;
    }

    public function getVMDes(): QVMChanDes
    {
        return $this->des;
    }
}
