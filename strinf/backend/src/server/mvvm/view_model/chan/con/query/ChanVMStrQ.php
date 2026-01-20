<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\query;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMDat;
use straininfo\server\mvvm\view_model\chan\dat\query\str\QVMDatAvg;
use straininfo\server\mvvm\view_model\chan\dat\query\str\QVMDatMax;
use straininfo\server\mvvm\view_model\chan\dat\query\str\QVMDatMin;

/**
 * @implements ToViewIntVMDat<\straininfo\server\shared\mvvm\view_model\data\ParStr, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat<\straininfo\server\shared\mvvm\view_model\data\ParStr>>
 */
final class ChanVMStrQ implements ToViewIntVMDat
{
    private readonly QVMDatAvg $avg;
    private readonly QVMDatMin $min;
    private readonly QVMDatMax $max;

    /**
     * @param QMIntDat<array<string, object>> $data
     */
    public function __construct(
        QMIntDat $data,
        string $chm,
        string $chv
    ) {
        $this->avg = new QVMDatAvg($data, $chm, $chv);
        $this->min = new QVMDatMin($data, $chm, $chv);
        $this->max = new QVMDatMax($data, $chm, $chv);
    }

    public function getVMAvg(): QVMDatAvg
    {
        return $this->avg;
    }

    public function getVMMax(): QVMDatMax
    {
        return $this->max;
    }

    public function getVMMin(): QVMDatMin
    {
        return $this->min;
    }
}
