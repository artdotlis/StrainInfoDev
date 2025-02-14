<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\arc\query;

use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntArc;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntArc;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class QVMChanArc implements QVMIntArc
{
    private readonly QMIntArc $q_arc_chan;

    public function __construct(
        QMIntArc $q_arc_chan,
        string $char_m,
        string $char_v
    ) {
        $this->q_arc_chan = $q_arc_chan;
        if ($char_m !== $char_v) {
            throw new KnownViewModelExc(
                "Model charset {$char_m} differs from view charset {$char_v}",
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
    }

    /** @param array<string, string> $res */
    public function createJson(array $res): string
    {
        $str_res = '[';
        foreach ($res as $json) {
            $str_res .= $json . ',';
        }
        if (strlen($str_res) > 1) {
            $str_res = substr($str_res, 0, -1);
        }
        return $str_res . ']';
    }

    protected function getMChan(): QMIntArc
    {
        return $this->q_arc_chan;
    }
}
