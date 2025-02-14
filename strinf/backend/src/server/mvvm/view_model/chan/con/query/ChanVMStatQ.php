<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\query;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMStat;
use straininfo\server\mvvm\view_model\chan\stat\query\QVMChanCPSCnt;

/**
 * @implements ToViewIntVMStat<int, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntStat<int>>
 */
final class ChanVMStatQ implements ToViewIntVMStat
{
    private readonly QVMChanCPSCnt $cps_cnt;

    /**
     * @param ToViewIntMQ<array<string, object>, array<string, object>> $to_view
     */
    public function __construct(ToViewIntMQ $to_view, string $char_m, string $char_v)
    {
        $this->cps_cnt = new QVMChanCPSCnt($to_view->getQMStat(), $char_m, $char_v);
    }

    public function getVMCulPStrCnt(): QVMChanCPSCnt
    {
        return $this->cps_cnt;
    }
}
