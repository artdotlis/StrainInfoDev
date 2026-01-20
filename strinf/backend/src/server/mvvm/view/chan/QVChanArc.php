<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view\chan;

use straininfo\server\interfaces\mvvm\controller\chan\QCIntArc;
use straininfo\server\interfaces\mvvm\view\chan\QVIntArc;

final class QVChanArc implements QVIntArc
{
    private readonly QCIntArc $q_chan;

    public function __construct(QCIntArc $q_chan)
    {
        $this->q_chan = $q_chan;
    }

    /** @return array{string, bool} */
    public function getArcSiId(string $id): array
    {
        return $this->q_chan->getArcSiId($id);
    }
}
