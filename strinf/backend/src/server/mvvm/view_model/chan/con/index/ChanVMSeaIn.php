<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\index;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDat;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDatSet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMInd;
use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMSeaOpt;
use straininfo\server\interfaces\mvvm\view_model\chan\search\VMIntSeaOpt;
use straininfo\server\mvvm\view_model\chan\dat\cache\CaVMDatMic;
use straininfo\server\mvvm\view_model\chan\dat\cache\CaVMDatMicInd;
use straininfo\server\mvvm\view_model\chan\sea\index\InVMTerm;
use straininfo\server\mvvm\view_model\chan\sea\search\VMSeaOpt;

final class ChanVMSeaIn implements ToViewIntVMSeaOpt
{
    private readonly InVMTerm $ind_term;
    private readonly VMIntSeaOpt $sea_opt;
    private readonly CaVMIntDat $dat_mic;
    private readonly CaVMIntDat $dat_mic_ind;

    public function __construct(
        ToViewIntMInd $to_view,
        CaMIntDat $get,
        CaMIntDatSet $set,
        int $key_len,
        string $char_m,
        string $char_v
    ) {
        $this->ind_term = new InVMTerm($to_view->getIndMEnt(), $key_len, $char_m, $char_v);
        $this->sea_opt = new VMSeaOpt();
        $this->dat_mic = new CaVMDatMic($get, $set, $char_m, $char_v);
        $this->dat_mic_ind = new CaVMDatMicInd($get, $set, $char_m, $char_v);
    }

    public function getVMIndSea(): InVMTerm
    {
        return $this->ind_term;
    }

    public function getVMOptSea(): VMIntSeaOpt
    {
        return $this->sea_opt;
    }

    public function getVMSeaMic(): CaVMIntDat
    {
        return $this->dat_mic;
    }

    public function getVMSeaMicInd(): CaVMIntDat
    {
        return $this->dat_mic_ind;
    }
}
