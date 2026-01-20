<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\dat\cache;

use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDat;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDatSet;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class CaVMChanDat implements CaVMIntDat
{
    private readonly CaMIntDat $b_chan;
    private readonly CaMIntDatSet $b_chan_set;

    public function __construct(
        CaMIntDat $b_chan,
        CaMIntDatSet $b_chan_set,
        string $char_m,
        string $char_v
    ) {
        $this->b_chan = $b_chan;
        $this->b_chan_set = $b_chan_set;
        if ($char_m !== $char_v) {
            throw new KnownViewModelExc(
                "Model charset {$char_m} differs from view charset {$char_v}",
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
    }

    protected function getMSetChan(): CaMIntDatSet
    {
        return $this->b_chan_set;
    }

    protected function getMChan(): CaMIntDat
    {
        return $this->b_chan;
    }
}
