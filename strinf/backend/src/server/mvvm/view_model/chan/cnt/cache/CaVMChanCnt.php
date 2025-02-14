<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\cnt\cache;

use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCnt;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntCntSet;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntCnt;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class CaVMChanCnt implements CaVMIntCnt
{
    private readonly CaMIntCnt $b_chan;
    private readonly CaMIntCntSet $b_chan_set;

    public function __construct(
        CaMIntCnt $b_chan,
        CaMIntCntSet $b_chan_set,
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

    protected function getMSetChan(): CaMIntCntSet
    {
        return $this->b_chan_set;
    }

    protected function getMChan(): CaMIntCnt
    {
        return $this->b_chan;
    }
}
