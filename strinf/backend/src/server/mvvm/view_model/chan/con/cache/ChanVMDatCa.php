<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDat;
use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntDatSet;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMDat;
use straininfo\server\mvvm\view_model\chan\dat\cache\CaVMDatAvg;
use straininfo\server\mvvm\view_model\chan\dat\cache\CaVMDatMax;
use straininfo\server\mvvm\view_model\chan\dat\cache\CaVMDatMin;

/**
 * @phpstan-type CaVMIntDat \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntDat
 *
 * @implements ToViewIntVMDat<null, CaVMIntDat>
 */
final class ChanVMDatCa implements ToViewIntVMDat
{
    private readonly CaVMDatAvg $avg;
    private readonly CaVMDatMin $min;
    private readonly CaVMDatMax $max;

    public function __construct(
        CaMIntDat $get,
        CaMIntDatSet $set,
        string $chm,
        string $chv
    ) {
        $this->min = new CaVMDatMin($get, $set, $chm, $chv);
        $this->avg = new CaVMDatAvg($get, $set, $chm, $chv);
        $this->max = new CaVMDatMax($get, $set, $chm, $chv);
    }

    public function getVMAvg(): CaVMDatAvg
    {
        return $this->avg;
    }

    public function getVMMax(): CaVMDatMax
    {
        return $this->max;
    }

    public function getVMMin(): CaVMDatMin
    {
        return $this->min;
    }
}
