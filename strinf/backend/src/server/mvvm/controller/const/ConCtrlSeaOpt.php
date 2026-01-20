<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\controller\const;

use straininfo\server\interfaces\mvvm\view_model\chan\index\InVMIntSea;
use straininfo\server\interfaces\mvvm\view_model\chan\search\VMIntSeaOpt;

final class ConCtrlSeaOpt
{
    public function __construct(
        private readonly InVMIntSea $index,
        private readonly VMIntSeaOpt $sea_opt
    ) {
    }

    public function getIndexKey(): InVMIntSea
    {
        return $this->index;
    }

    public function getSeaOpt(): VMIntSeaOpt
    {
        return $this->sea_opt;
    }
}
