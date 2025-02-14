<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\cnt\query;

use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntCnt;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntCnt;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class QVMChanCnt implements QVMIntCnt
{
    private readonly QMIntCnt $q_cnt_chan;

    public function __construct(
        QMIntCnt $q_cnt_chan,
        string $char_m,
        string $char_v
    ) {
        $this->q_cnt_chan = $q_cnt_chan;
        if ($char_m !== $char_v) {
            throw new KnownViewModelExc(
                "Model charset {$char_m} differs from view charset {$char_v}",
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
    }

    public function createJson(int $cnt): string
    {
        return "[{$cnt}]";
    }

    protected function getMChan(): QMIntCnt
    {
        return $this->q_cnt_chan;
    }
}
