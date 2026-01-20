<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\query;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMSeaCul;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMBrc;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMCulStr;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMSeq;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMStrDes;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMStrNo;
use straininfo\server\mvvm\view_model\chan\sea\query\QVMTaxName;

/**
 * @implements ToViewIntVMSeaCul<\straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId<string>>
 */
final class ChanVMCulSeaQ implements ToViewIntVMSeaCul
{
    private readonly QVMTaxName $txn;
    private readonly QVMStrDes $std;
    private readonly QVMStrNo $stn;
    private readonly QVMCulStr $str;
    private readonly QVMSeq $seq;
    private readonly QVMBrc $brc;

    /**
     * @param ToViewIntMQ<array<string, object>, array<string, object>> $to_view
     */
    public function __construct(ToViewIntMQ $to_view, string $char_m, string $char_v)
    {
        $this->txn = new QVMTaxName($to_view->getQMCulSea(), $char_m, $char_v);
        $this->std = new QVMStrDes($to_view->getQMCulSea(), $char_m, $char_v);
        $this->stn = new QVMStrNo($to_view->getQMCulSea(), $char_m, $char_v);
        $this->str = new QVMCulStr($to_view->getQMCulSea(), $char_m, $char_v);
        $this->seq = new QVMSeq($to_view->getQMCulSea(), $char_m, $char_v);
        $this->brc = new QVMBrc($to_view->getQMCulSea(), $char_m, $char_v);
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

    public function getVMStr(): QVMCulStr
    {
        return $this->str;
    }

    public function getVMBrc(): QVMBrc
    {
        return $this->brc;
    }

    public function getVMSeq(): QVMSeq
    {
        return $this->seq;
    }
}
