<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\cache;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMSeaStr;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMBrc;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMSeq;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMStrCul;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMStrDes;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMStrNo;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMTaxName;

/**
 * @implements ToViewIntVMSeaStr<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<string>>
 */
final class ChanVMStrSeaCa implements ToViewIntVMSeaStr
{
    private readonly CaVMStrDes $std;
    private readonly CaVMTaxName $txn;
    private readonly CaVMStrNo $stn;
    private readonly CaVMSeq $seq;
    private readonly CaVMBrc $brc;
    private readonly CaVMStrCul $cul;

    public function __construct(
        ToViewIntMCaGet $get,
        ToViewIntMCaSet $set,
        string $chm,
        string $chv
    ) {
        $strSeaG = $get->getCaMStrSea();
        $strSeaS = $set->getCaMStrSea();
        $this->std = new CaVMStrDes($strSeaG, $strSeaS, $chm, $chv);
        $this->txn = new CaVMTaxName($strSeaG, $strSeaS, $chm, $chv);
        $this->stn = new CaVMStrNo($strSeaG, $strSeaS, $chm, $chv);
        $this->seq = new CaVMSeq($strSeaG, $strSeaS, $chm, $chv);
        $this->brc = new CaVMBrc($strSeaG, $strSeaS, $chm, $chv);
        $this->cul = new CaVMStrCul($strSeaG, $strSeaS, $chm, $chv);
    }

    public function getVMStrDes(): CaVMStrDes
    {
        return $this->std;
    }

    public function getVMSeq(): CaVMSeq
    {
        return $this->seq;
    }

    public function getVMBrc(): CaVMBrc
    {
        return $this->brc;
    }

    public function getVMTaxName(): CaVMTaxName
    {
        return $this->txn;
    }

    public function getVMStrNo(): CaVMStrNo
    {
        return $this->stn;
    }

    public function getVMCul(): CaVMStrCul
    {
        return $this->cul;
    }
}
