<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntOptSea;
use straininfo\server\interfaces\mvvm\view\chan\QVIntOptSea;

final class QVChanSeaOpt implements QVIntOptSea
{
    private readonly QCIntOptSea $q_chan;

    public function __construct(QCIntOptSea $q_chan)
    {
        $this->q_chan = $q_chan;
    }

    /** @return array{string, bool} */
    public function getIndexKey(string $ind_key): array
    {
        return $this->q_chan->getIndSea($ind_key);
    }

    /** @return array{string, bool} */
    public function getSeaMic(string $si_id): array
    {
        return $this->q_chan->getSeaMic(QVChanDat::correctRanges($si_id));
    }

    /** @return array{string, bool} */
    public function getSeaMicAll(int $ind): array
    {
        return $this->q_chan->getSeaMicAll($ind);
    }
}
