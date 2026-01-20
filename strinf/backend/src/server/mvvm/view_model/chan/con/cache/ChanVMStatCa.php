<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\cache;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMStat;
use straininfo\server\mvvm\view_model\chan\stat\cache\CaVMChanCPSCnt;

/**
 * @phpstan-type CaVMIntStat \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntStat
 *
 * @implements ToViewIntVMStat<null, CaVMIntStat>
 */
final class ChanVMStatCa implements ToViewIntVMStat
{
    private readonly CaVMChanCPSCnt $cps;

    public function __construct(
        ToViewIntMCaGet $get,
        ToViewIntMCaSet $set,
        string $chm,
        string $chv
    ) {
        $this->cps = new CaVMChanCPSCnt(
            $get->getCaMStat(),
            $set->getCaMStat(),
            $chm,
            $chv
        );
    }

    public function getVMCulPStrCnt(): CaVMChanCPSCnt
    {
        return $this->cps;
    }
}
