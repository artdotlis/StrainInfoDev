<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntSeaStrId;
use straininfo\server\interfaces\mvvm\view\chan\QVIntSeaIdStr;

final class QVChanSeaStr extends QVChanSea implements QVIntSeaIdStr
{
    private readonly QCIntSeaStrId $q_chan;

    public function __construct(QCIntSeaStrId $q_chan)
    {
        $this->q_chan = $q_chan;
        parent::__construct($q_chan);
    }

    /** @return array{string, bool} */
    public function getCulId(string $cul_id): array
    {
        return $this->q_chan->getCulId($cul_id);
    }
}
