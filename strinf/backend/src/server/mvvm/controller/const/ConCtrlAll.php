<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\const;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntAll;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntAll;

/** @template T of CaVMIntAll|QVMIntAll */
final class ConCtrlAll
{
    /**
     * @param T $t_cul
     * @param T $cul
     * @param T $str
     * @param T $t_str
     */
    public function __construct(
        private readonly CaVMIntAll|QVMIntAll $t_cul,
        private readonly CaVMIntAll|QVMIntAll $cul,
        private readonly CaVMIntAll|QVMIntAll $str,
        private readonly CaVMIntAll|QVMIntAll $t_str
    ) {
    }

    /** @return T */
    public function getStr()
    {
        return $this->str;
    }

    /** @return T */
    public function getTStr()
    {
        return $this->t_str;
    }

    /** @return T */
    public function getCul()
    {
        return $this->cul;
    }

    /** @return T */
    public function getTCul()
    {
        return $this->t_cul;
    }
}
