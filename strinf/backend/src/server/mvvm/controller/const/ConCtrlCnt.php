<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\const;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntCnt;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntCnt;

/** @template T of CaVMIntCnt|QVMIntCnt */
final class ConCtrlCnt
{
    /**
     * @param T $spe
     * @param T $cul
     * @param T $str
     * @param T $arc
     * @param T $t_str
     * @param T $t_cul
     * @param T $des
     */
    public function __construct(
        private readonly CaVMIntCnt|QVMIntCnt $spe,
        private readonly CaVMIntCnt|QVMIntCnt $cul,
        private readonly CaVMIntCnt|QVMIntCnt $str,
        private readonly CaVMIntCnt|QVMIntCnt $t_str,
        private readonly CaVMIntCnt|QVMIntCnt $arc,
        private readonly CaVMIntCnt|QVMIntCnt $t_cul,
        private readonly CaVMIntCnt|QVMIntCnt $des
    ) {
    }

    /** @return T */
    public function getStr()
    {
        return $this->str;
    }

    /** @return T */
    public function getArc()
    {
        return $this->arc;
    }

    /** @return T */
    public function getTStr()
    {
        return $this->t_str;
    }

    /** @return T */
    public function getTCul()
    {
        return $this->t_cul;
    }

    /** @return T */
    public function getCul()
    {
        return $this->cul;
    }

    /** @return T */
    public function getSpe()
    {
        return $this->spe;
    }

    /** @return T */
    public function getDes()
    {
        return $this->des;
    }
}
