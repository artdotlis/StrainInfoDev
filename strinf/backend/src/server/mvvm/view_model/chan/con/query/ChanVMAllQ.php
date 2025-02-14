<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\query;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMAll;
use straininfo\server\mvvm\view_model\chan\all\query\QVMChanCul;
use straininfo\server\mvvm\view_model\chan\all\query\QVMChanStr;
use straininfo\server\mvvm\view_model\chan\all\query\QVMChanTCul;
use straininfo\server\mvvm\view_model\chan\all\query\QVMChanTStr;

/**
 * @phpstan-type QVMIntAll \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntAll
 *
 * @implements ToViewIntVMAll<QVMIntAll>
 */
final class ChanVMAllQ implements ToViewIntVMAll
{
    private readonly QVMChanCul $cul;
    private readonly QVMChanStr $str;
    private readonly QVMChanTStr $t_str;
    private readonly QVMChanTCul $t_cul;

    /**
     * @param ToViewIntMQ<array<string, object>, array<string, object>> $to_view
     */
    public function __construct(ToViewIntMQ $to_view, string $char_m, string $char_v)
    {
        $this->cul = new QVMChanCul($to_view->getQMAll(), $char_m, $char_v);
        $this->t_cul = new QVMChanTCul($to_view->getQMAll(), $char_m, $char_v);
        $this->str = new QVMChanStr($to_view->getQMAll(), $char_m, $char_v);
        $this->t_str = new QVMChanTStr($to_view->getQMAll(), $char_m, $char_v);
    }

    public function getVMCul(): QVMChanCul
    {
        return $this->cul;
    }

    public function getVMStr(): QVMChanStr
    {
        return $this->str;
    }

    public function getVMTStr(): QVMChanTStr
    {
        return $this->t_str;
    }

    public function getVMTCul(): QVMChanTCul
    {
        return $this->t_cul;
    }
}
