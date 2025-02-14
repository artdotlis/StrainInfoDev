<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\con;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntCnt;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntCnt;

/** @template T of CaVMIntCnt|QVMIntCnt */
interface ToViewIntVMCnt
{
    /** @return T */
    public function getVMCul(): CaVMIntCnt|QVMIntCnt;

    /** @return T */
    public function getVMStr(): CaVMIntCnt|QVMIntCnt;

    /** @return T */
    public function getVMArc(): CaVMIntCnt|QVMIntCnt;

    /** @return T */
    public function getVMTStr(): CaVMIntCnt|QVMIntCnt;

    /** @return T */
    public function getVMTCul(): CaVMIntCnt|QVMIntCnt;

    /** @return T */
    public function getVMSpe(): CaVMIntCnt|QVMIntCnt;

    /** @return T */
    public function getVMDes(): CaVMIntCnt|QVMIntCnt;
}
