<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\query;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMQ;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMArc;
use straininfo\server\mvvm\view_model\chan\arc\query\QVMChanSIID;

/**
 * @phpstan-type QVMIntArc \straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntArc
 *
 * @implements ToViewIntVMArc<QVMIntArc>
 */
final class ChanVMArcQ implements ToViewIntVMArc
{
    private readonly QVMChanSIID $arc;

    /**
     * @param ToViewIntMQ<array<string, object>, array<string, object>> $tvc
     */
    public function __construct(
        ToViewIntMQ $tvc,
        string $chm,
        string $chv
    ) {
        $this->arc = new QVMChanSIID($tvc->getQMArc(), $chm, $chv);
    }

    public function getVMArc(): QVMChanSIID
    {
        return $this->arc;
    }
}
