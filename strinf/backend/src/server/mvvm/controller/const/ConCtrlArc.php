<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\const;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntArc;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntArc;

/** @template T of CaVMIntArc|QVMIntArc */
final class ConCtrlArc
{
    /** @param T $arc */
    public function __construct(
        private readonly CaVMIntArc|QVMIntArc $arc
    ) {
    }

    /** @return T */
    public function getArc()
    {
        return $this->arc;
    }
}
