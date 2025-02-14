<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\stat\query;

use Safe\Exceptions\JsonException;
use function Safe\json_encode;
use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\model\chan\query\QMIntStat;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntStat;
use straininfo\server\shared\exc\KEAct;

use straininfo\server\shared\logger\LogLevE;

/**
 * @template T
 *
 * @implements QVMIntStat<T>
 */
abstract class QVMChanDis implements QVMIntStat
{
    private readonly QMIntStat $q_chan;

    public function __construct(
        QMIntStat $q_chan,
        string $char_m,
        string $char_v
    ) {
        $this->q_chan = $q_chan;
        if ($char_m !== $char_v) {
            throw new KnownViewModelExc(
                "Model charset {$char_m} differs from view charset {$char_v}",
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
    }

    /** @param array<string, array<T>> $data */
    public function createJson(array $data): string
    {
        try {
            return json_encode([$data]);
        } catch (JsonException) {
            $msg = 'Could not encode dis array as json!';
            throw new KnownViewModelExc($msg, LogLevE::CRITICAL, KEAct::TERM);
        }
    }

    protected function getMChan(): QMIntStat
    {
        return $this->q_chan;
    }
}
