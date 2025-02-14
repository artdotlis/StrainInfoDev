<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\const;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntStat;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntStat;

/** @template T of CaVMIntStat|QVMIntStat */
final class ConCtrlStat
{
    /** @param T $cul_per_str */
    public function __construct(
        private readonly CaVMIntStat|QVMIntStat $cul_per_str
    ) {
    }

    /** @return T */
    public function getCulPStrCnt()
    {
        return $this->cul_per_str;
    }
}
