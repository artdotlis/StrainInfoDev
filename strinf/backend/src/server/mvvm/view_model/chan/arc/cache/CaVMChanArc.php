<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\arc\cache;

use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArc;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntArcSet;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntArc;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class CaVMChanArc implements CaVMIntArc
{
    private readonly CaMIntArc $b_chan;
    private readonly CaMIntArcSet $b_chan_set;

    public function __construct(
        CaMIntArc $b_chan,
        CaMIntArcSet $b_chan_set,
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

    protected function getMSetChan(): CaMIntArcSet
    {
        return $this->b_chan_set;
    }

    protected function getMChan(): CaMIntArc
    {
        return $this->b_chan;
    }
}
