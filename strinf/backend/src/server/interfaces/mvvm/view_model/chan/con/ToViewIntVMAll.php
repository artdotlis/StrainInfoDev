<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\con;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntAll;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntAll;

/** @template T of CaVMIntAll|QVMIntAll */
interface ToViewIntVMAll
{
    /** @return T */
    public function getVMCul(): CaVMIntAll|QVMIntAll;

    /** @return T */
    public function getVMStr(): CaVMIntAll|QVMIntAll;

    /** @return T */
    public function getVMTStr(): CaVMIntAll|QVMIntAll;

    /** @return T */
    public function getVMTCul(): CaVMIntAll|QVMIntAll;
}
