<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntStat;
use straininfo\server\mvvm\controller\const\ConCtrlStat;

use function straininfo\server\mvvm\controller\const\get_stat_2d;

final class QCChanStat implements QCIntStat
{
    /**
     * @param ConCtrlStat<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntStat<int>> $q_stat
     * @param ConCtrlStat<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntStat> $b_stat
     */
    public function __construct(
        private readonly ConCtrlStat $q_stat,
        private readonly ConCtrlStat $b_stat
    ) {
    }

    public function getCulPStrCnt(): string
    {
        return get_stat_2d(
            $this->q_stat->getCulPStrCnt(),
            $this->b_stat->getCulPStrCnt()
        );
    }
}
