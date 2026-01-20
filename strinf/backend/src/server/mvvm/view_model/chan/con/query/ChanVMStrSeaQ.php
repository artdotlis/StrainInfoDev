<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\query;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMSeaStr;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMBrc;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMSeq;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMStrCul;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMStrDes;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMStrNo;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMTaxName;

/**
 * @implements ToViewIntVMSeaStr<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<string>>
 */
final class ChanVMStrSeaQ implements ToViewIntVMSeaStr
{
    private readonly QVMTaxName $txn;
    private readonly QVMStrDes $std;
    private readonly QVMStrNo $stn;
    private readonly QVMSeq $seq;
    private readonly QVMBrc $brc;
    private readonly QVMStrCul $cul;

    /**
     * @param ToViewIntMQ<array<string, object>, array<string, object>> $to_view
     */
    public function __construct(ToViewIntMQ $to_view, string $char_m, string $char_v)
    {
        $this->txn = new QVMTaxName($to_view->getQMStrSea(), $char_m, $char_v);
        $this->std = new QVMStrDes($to_view->getQMStrSea(), $char_m, $char_v);
        $this->stn = new QVMStrNo($to_view->getQMStrSea(), $char_m, $char_v);
        $this->seq = new QVMSeq($to_view->getQMStrSea(), $char_m, $char_v);
        $this->brc = new QVMBrc($to_view->getQMStrSea(), $char_m, $char_v);
        $this->cul = new QVMStrCul($to_view->getQMStrSea(), $char_m, $char_v);
    }

    public function getVMTaxName(): QVMTaxName
    {
        return $this->txn;
    }

    public function getVMStrDes(): QVMStrDes
    {
        return $this->std;
    }

    public function getVMStrNo(): QVMStrNo
    {
        return $this->stn;
    }

    public function getVMBrc(): QVMBrc
    {
        return $this->brc;
    }

    public function getVMSeq(): QVMSeq
    {
        return $this->seq;
    }
    public function getVMCul(): QVMStrCul
    {
        return $this->cul;
    }
}
