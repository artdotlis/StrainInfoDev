<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\con;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\index\InVMIntSea;
use straininfo\server\interfaces\mvvm\view_model\chan\search\VMIntSeaOpt;

interface ToViewIntVMSeaOpt
{
    public function getVMIndSea(): InVMIntSea;

    public function getVMOptSea(): VMIntSeaOpt;

    public function getVMSeaMic(): CaVMIntDat;

    public function getVMSeaMicInd(): CaVMIntDat;
}
