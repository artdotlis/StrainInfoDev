<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\stat\cache;

use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStat;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntStatSet;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntStat;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class CaVMChanStat implements CaVMIntStat
{
    private readonly CaMIntStat $b_chan;
    private readonly CaMIntStatSet $b_chan_set;

    public function __construct(
        CaMIntStat $b_chan,
        CaMIntStatSet $b_chan_set,
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

    protected function getMSetChan(): CaMIntStatSet
    {
        return $this->b_chan_set;
    }

    protected function getMChan(): CaMIntStat
    {
        return $this->b_chan;
    }
}
