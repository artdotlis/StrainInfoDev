<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model;

use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMAll;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMArc;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMSeaOpt;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMStat;

/**
 * @template TD
 */
interface TVConSerInt
{
    /**
     * @return ToViewIntVMAll<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntAll>
     */
    public function getToViewCaChanAll(): ToViewIntVMAll;

    /**
     * @return ToViewIntVMStat<null, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntStat>
     */
    public function getToViewCaChanStat(): ToViewIntVMStat;

    /**
     * @return ToViewIntVMArc<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntArc>
     */
    public function getToViewCaChanArc(): ToViewIntVMArc;

    /**
     * @return ToViewIntVMArc<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntArc>
     */
    public function getToViewQChanArc(): ToViewIntVMArc;

    /**
     * @return ToViewIntVMAll<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntAll>
     */
    public function getToViewQChanAll(): ToViewIntVMAll;

    /**
     * @return ToViewIntVMStat<TD, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntStat<TD>>
     */
    public function getToViewQChanStat(): ToViewIntVMStat;

    public function getToViewOptSeaChanSea(): ToViewIntVMSeaOpt;
}
