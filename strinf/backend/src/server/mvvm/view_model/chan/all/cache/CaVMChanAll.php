<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\all\cache;

use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAll;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntAllSet;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntAll;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class CaVMChanAll implements CaVMIntAll
{
    private readonly CaMIntAll $b_chan;
    private readonly CaMIntAllSet $b_chan_set;

    public function __construct(
        CaMIntAll $b_chan,
        CaMIntAllSet $b_chan_set,
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

    protected function getMSetChan(): CaMIntAllSet
    {
        return $this->b_chan_set;
    }

    protected function getMChan(): CaMIntAll
    {
        return $this->b_chan;
    }
}
