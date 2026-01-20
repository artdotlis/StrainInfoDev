<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntCnt;
use straininfo\server\interfaces\mvvm\view\chan\QVIntCnt;

final class QVChanCnt implements QVIntCnt
{
    private readonly QCIntCnt $q_chan;

    public function __construct(QCIntCnt $q_chan)
    {
        $this->q_chan = $q_chan;
    }

    public function getStrainCount(): string
    {
        return $this->q_chan->getStrainCount();
    }

    public function getArchiveCount(): string
    {
        return $this->q_chan->getArchiveCount();
    }

    public function getTypeStrainCount(): string
    {
        return $this->q_chan->getTypeStrainCount();
    }

    public function getTypeCultureCount(): string
    {
        return $this->q_chan->getTypeCultureCount();
    }

    public function getCultureCount(): string
    {
        return $this->q_chan->getCultureCount();
    }

    public function getDesignationCount(): string
    {
        return $this->q_chan->getDesignationCount();
    }

    public function getSpeciesCount(): string
    {
        return $this->q_chan->getSpeciesCount();
    }
}
