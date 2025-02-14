<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntOptSea;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntAll;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntAll;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat;
use straininfo\server\mvvm\controller\const\ConCtrlSeaOpt;

use function straininfo\server\mvvm\controller\const\sea_index_term;
use function straininfo\server\mvvm\controller\const\sea_mic;
use function straininfo\server\mvvm\controller\const\sea_mic_all;

final class QCChanSeaOpt implements QCIntOptSea
{
    /**
     *  @param \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat<\straininfo\server\shared\mvvm\view_model\data\ParStr> $sea_q
     */
    public function __construct(
        private readonly ConCtrlSeaOpt $sea_opt,
        private readonly QVMIntDat $sea_q,
        private readonly CaVMIntDat $ca_min,
        private readonly CaVMIntDat $ca_mic,
        private readonly CaVMIntDat $ca_mic_ind,
        private readonly QVMIntAll $all_q,
        private readonly CaVMIntAll $all_b
    ) {
    }

    /** @return array{string, bool} */
    public function getIndSea(string $sea_key): array
    {
        return sea_index_term($sea_key, $this->sea_opt->getIndexKey());
    }

    /** @return array{string, bool} */
    public function getSeaMic(string $si_id): array
    {
        return sea_mic($si_id, $this->sea_q, $this->ca_min, $this->ca_mic, $this->sea_opt->getSeaOpt());
    }

    /** @return array{string, bool} */
    public function getSeaMicAll(int $ind): array
    {
        return sea_mic_all(
            $ind,
            $this->all_q,
            $this->all_b,
            $this->sea_q,
            $this->ca_min,
            $this->ca_mic_ind,
            $this->sea_opt->getSeaOpt()
        );
    }
}
