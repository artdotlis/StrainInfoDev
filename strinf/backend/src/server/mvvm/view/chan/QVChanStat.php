<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntStat;
use straininfo\server\interfaces\mvvm\view\chan\QVIntStat;

final class QVChanStat implements QVIntStat
{
    private readonly QCIntStat $q_chan;

    public function __construct(QCIntStat $q_chan)
    {
        $this->q_chan = $q_chan;
    }

    public function getCulPStrCnt(): string
    {
        return $this->q_chan->getCulPStrCnt();
    }
}
