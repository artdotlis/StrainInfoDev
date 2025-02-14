<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\con;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntStat;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntStat;

/**
 * @template TD
 * @template T of CaVMIntStat|QVMIntStat<TD>
 */
interface ToViewIntVMStat
{
    /** @return T */
    public function getVMCulPStrCnt(): CaVMIntStat|QVMIntStat;
}
