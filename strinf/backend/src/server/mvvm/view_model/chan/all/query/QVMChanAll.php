<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\all\query;

use function Safe\preg_replace;
use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntAll;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntAll;
use straininfo\server\shared\exc\KEAct;

use straininfo\server\shared\logger\LogLevE;

abstract class QVMChanAll implements QVMIntAll
{
    private readonly QMIntAll $q_all_chan;

    public function __construct(
        QMIntAll $q_all_chan,
        string $char_m,
        string $char_v
    ) {
        $this->q_all_chan = $q_all_chan;
        if ($char_m !== $char_v) {
            throw new KnownViewModelExc(
                "Model charset {$char_m} differs from view charset {$char_v}",
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
    }

    /** @param array<int> $ids */
    public function createJson(array $ids): string
    {
        $res = implode(',', $ids);
        return "[{$res}]";
    }

    /** @return array<int> */
    public function parseJson(string $json): array
    {
        $all_ids = preg_replace("/\[|\]/", '', $json);
        return array_map(static function (string $val) {
            $parsed = intval($val);
            if ($parsed === 0) {
                throw new KnownViewModelExc(
                    "All strain results should only contain integers, got {$val}",
                    LogLevE::WARNING,
                    KEAct::WARN
                );
            }
            return $parsed;
        }, explode(',', $all_ids));
    }

    protected function getMChan(): QMIntAll
    {
        return $this->q_all_chan;
    }
}
