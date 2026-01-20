<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\cache;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMAll;
use straininfo\server\mvvm\view_model\chan\all\cache\CaVMChanCul;
use straininfo\server\mvvm\view_model\chan\all\cache\CaVMChanStr;
use straininfo\server\mvvm\view_model\chan\all\cache\CaVMChanTCul;
use straininfo\server\mvvm\view_model\chan\all\cache\CaVMChanTStr;

/**
 * @phpstan-type CaVMIntAll \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntAll
 *
 * @implements ToViewIntVMAll<CaVMIntAll>
 */
final class ChanVMAllCa implements ToViewIntVMAll
{
    private readonly CaVMChanCul $cul;
    private readonly CaVMChanStr $str;
    private readonly CaVMChanTStr $t_str;
    private readonly CaVMChanTCul $t_cul;

    public function __construct(
        ToViewIntMCaGet $get,
        ToViewIntMCaSet $set,
        string $chm,
        string $chv
    ) {
        $this->cul = new CaVMChanCul($get->getCaMAll(), $set->getCaMAll(), $chm, $chv);
        $this->t_cul = new CaVMChanTCul($get->getCaMAll(), $set->getCaMAll(), $chm, $chv);
        $this->str = new CaVMChanStr($get->getCaMAll(), $set->getCaMAll(), $chm, $chv);
        $this->t_str = new CaVMChanTStr($get->getCaMAll(), $set->getCaMAll(), $chm, $chv);
    }

    public function getVMCul(): CaVMChanCul
    {
        return $this->cul;
    }

    public function getVMStr(): CaVMChanStr
    {
        return $this->str;
    }

    public function getVMTStr(): CaVMChanTStr
    {
        return $this->t_str;
    }

    public function getVMTCul(): CaVMChanTCul
    {
        return $this->t_cul;
    }
}
