<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\cache;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMArc;
use straininfo\server\mvvm\view_model\chan\arc\cache\CaVMChanSIID;

/**
 * @phpstan-type CaVMIntArc \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntArc
 *
 * @implements ToViewIntVMArc<CaVMIntArc>
 */
final class ChanVMArcCa implements ToViewIntVMArc
{
    private readonly CaVMChanSIID $arc;

    public function __construct(
        ToViewIntMCaGet $get,
        ToViewIntMCaSet $set,
        string $chm,
        string $chv
    ) {
        $this->arc = new CaVMChanSIID($get->getCaMArc(), $set->getCaMArc(), $chm, $chv);
    }

    public function getVMArc(): CaVMChanSIID
    {
        return $this->arc;
    }
}
