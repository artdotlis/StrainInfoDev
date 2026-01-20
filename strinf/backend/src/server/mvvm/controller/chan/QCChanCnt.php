<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntCnt;
use straininfo\server\mvvm\controller\const\ConCtrlCnt;

use function straininfo\server\mvvm\controller\const\get_count;

final class QCChanCnt implements QCIntCnt
{
    /**
     * @param ConCtrlCnt<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntCnt> $q_cnt
     * @param ConCtrlCnt<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntCnt> $b_cnt
     */
    public function __construct(
        private readonly ConCtrlCnt $q_cnt,
        private readonly ConCtrlCnt $b_cnt
    ) {
    }

    public function getStrainCount(): string
    {
        return get_count($this->q_cnt->getStr(), $this->b_cnt->getStr());
    }

    public function getArchiveCount(): string
    {
        return get_count($this->q_cnt->getArc(), $this->b_cnt->getArc());
    }

    public function getTypeStrainCount(): string
    {
        return get_count($this->q_cnt->getTStr(), $this->b_cnt->getTStr());
    }

    public function getTypeCultureCount(): string
    {
        return get_count($this->q_cnt->getTCul(), $this->b_cnt->getTCul());
    }

    public function getCultureCount(): string
    {
        return get_count($this->q_cnt->getCul(), $this->b_cnt->getCul());
    }

    public function getSpeciesCount(): string
    {
        return get_count($this->q_cnt->getSpe(), $this->b_cnt->getSpe());
    }

    public function getDesignationCount(): string
    {
        return get_count($this->q_cnt->getDes(), $this->b_cnt->getDes());
    }
}
