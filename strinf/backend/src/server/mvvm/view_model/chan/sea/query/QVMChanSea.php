<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\query;

use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

/**
 * @template T of string|int
 * @template M of \straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaId|\straininfo\server\interfaces\mvvm\model\chan\query\QMIntSeaIdCul
 *
 * @implements QVMIntSeaId<T>
 */
abstract class QVMChanSea implements QVMIntSeaId
{
    /** @var M */
    private readonly mixed $q_search_chan;

    /** @param M $q_search_chan */
    public function __construct(
        $q_search_chan,
        string $char_m,
        string $char_v
    ) {
        $this->q_search_chan = $q_search_chan;
        if ($char_m !== $char_v) {
            throw new KnownViewModelExc(
                "Model charset {$char_m} differs from view charset {$char_v}",
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
    }

    public function createJson(string $ids): string
    {
        return "[{$ids}]";
    }

    /** @return M */
    protected function getMChan()
    {
        return $this->q_search_chan;
    }
}
