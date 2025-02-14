<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\con;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat;

/**
 * @template TV
 * @template T of CaVMIntDat|QVMIntDat<TV>
 */
interface ToViewIntVMDat
{
    /** @return T */
    public function getVMAvg(): CaVMIntDat|QVMIntDat;

    /** @return T */
    public function getVMMax(): CaVMIntDat|QVMIntDat;

    /** @return T */
    public function getVMMin(): CaVMIntDat|QVMIntDat;
}
