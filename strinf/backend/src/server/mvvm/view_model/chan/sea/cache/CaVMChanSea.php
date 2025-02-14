<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\sea\cache;

use straininfo\server\exceptions\mvvm\view_model\KnownViewModelExc;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

/**
 * @template T of string|int
 * @template MG of \straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaId|\straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdCul
 * @template MS of \straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSet|\straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdSetCul
 *
 * @implements CaVMIntSeaId<T>
 */
abstract class CaVMChanSea implements CaVMIntSeaId
{
    /** @var MG */
    private readonly mixed $search_chan;

    /** @var MS */
    private readonly mixed $set_search_chan;

    /**
     * @param MG $search_chan
     * @param MS $set_search_chan
     */
    public function __construct(
        $search_chan,
        $set_search_chan,
        string $char_m,
        string $char_v
    ) {
        if ($char_m !== $char_v) {
            throw new KnownViewModelExc(
                "Model charset {$char_m} differs from view charset {$char_v}",
                LogLevE::CRITICAL,
                KEAct::TERM
            );
        }
        $this->search_chan = $search_chan;
        $this->set_search_chan = $set_search_chan;
    }

    /** @return MS */
    protected function getMSetChan()
    {
        return $this->set_search_chan;
    }

    /** @return MG */
    protected function getMChan()
    {
        return $this->search_chan;
    }
}
