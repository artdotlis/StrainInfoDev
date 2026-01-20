<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntSeaId;
use straininfo\server\interfaces\mvvm\view\chan\QVIntSeaId;

abstract class QVChanSea implements QVIntSeaId
{
    private readonly QCIntSeaId $q_chan;

    public function __construct(QCIntSeaId $q_chan)
    {
        $this->q_chan = $q_chan;
    }

    /** @return array{string, bool} */
    public function getSeqAcc(string $seq_acc): array
    {
        return $this->q_chan->getSeqAcc($seq_acc);
    }

    /** @return array{string, bool} */
    public function getStrNo(string $str_no): array
    {
        return $this->q_chan->getStrNo($str_no);
    }

    /** @return array{string, bool} */
    public function getTaxName(string $tax_name): array
    {
        return $this->q_chan->getTaxName($tax_name);
    }

    /** @return array{string, bool} */
    public function getStrDes(string $str_des): array
    {
        return $this->q_chan->getStrDes($str_des);
    }

    /** @return array{string, bool} */
    public function getBrc(string $brc): array
    {
        return $this->q_chan->getBrc($brc);
    }
}
