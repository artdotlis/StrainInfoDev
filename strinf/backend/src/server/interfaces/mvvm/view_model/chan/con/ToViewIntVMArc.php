<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\con;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntArc;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntArc;

/** @template T of CaVMIntArc|QVMIntArc */
interface ToViewIntVMArc
{
    /** @return T */
    public function getVMArc(): CaVMIntArc|QVMIntArc;
}
