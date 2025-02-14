<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\query;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntDat;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMDat;
use straininfo\server\mvvm\view_model\chan\dat\query\cul\QVMDatAvg;
use straininfo\server\mvvm\view_model\chan\dat\query\cul\QVMDatMax;
use straininfo\server\mvvm\view_model\chan\dat\query\cul\QVMDatMin;

/**
 * @implements ToViewIntVMDat<\straininfo\server\shared\mvvm\view_model\data\ParCul, \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntDat<\straininfo\server\shared\mvvm\view_model\data\ParCul>>
 */
final class ChanVMCulQ implements ToViewIntVMDat
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
