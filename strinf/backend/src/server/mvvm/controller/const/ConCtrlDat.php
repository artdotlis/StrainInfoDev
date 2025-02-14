<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\const;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat;

/**
 * @template TV
 * @template T of CaVMIntDat|QVMIntDat<TV>
 */
final class ConCtrlDat
{
    /**
     * @param T $min
     * @param T $avg
     * @param T $max
     */
    public function __construct(
        private readonly CaVMIntDat|QVMIntDat $min,
        private readonly CaVMIntDat|QVMIntDat $avg,
        private readonly CaVMIntDat|QVMIntDat $max
    ) {
    }

    /** @return T */
    public function getAvg()
    {
        return $this->avg;
    }

    /** @return T */
    public function getMax()
    {
        return $this->max;
    }

    /** @return T */
    public function getMin()
    {
        return $this->min;
    }
}
