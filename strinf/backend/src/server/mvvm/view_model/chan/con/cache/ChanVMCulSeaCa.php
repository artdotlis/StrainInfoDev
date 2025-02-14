<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\view_model\chan\con\cache;

use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaGet;
use straininfo\server\interfaces\mvvm\model\chan\con\ToViewIntMCaSet;
use straininfo\server\interfaces\mvvm\view_model\chan\con\ToViewIntVMSeaCul;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMBrc;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMCulStr;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMSeq;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMStrDes;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMStrNo;
use straininfo\server\mvvm\view_model\chan\sea\cache\CaVMTaxName;

/**
 * @implements ToViewIntVMSeaCul<\straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<int>, \straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId<string>>
 */
final class ChanVMCulSeaCa implements ToViewIntVMSeaCul
{
    private readonly CaVMCulStr $str;
    private readonly CaVMStrDes $std;
    private readonly CaVMTaxName $txn;
    private readonly CaVMStrNo $stn;
    private readonly CaVMSeq $seq;
    private readonly CaVMBrc $brc;

    public function __construct(
        ToViewIntMCaGet $get,
        ToViewIntMCaSet $set,
        string $chm,
        string $chv
    ) {
        $culSeaG = $get->getCaMCulSea();
        $culSeaS = $set->getCaMCulSea();
        $this->str = new CaVMCulStr($culSeaG, $culSeaS, $chm, $chv);
        $this->std = new CaVMStrDes($culSeaG, $culSeaS, $chm, $chv);
        $this->txn = new CaVMTaxName($culSeaG, $culSeaS, $chm, $chv);
        $this->stn = new CaVMStrNo($culSeaG, $culSeaS, $chm, $chv);
        $this->seq = new CaVMSeq($culSeaG, $culSeaS, $chm, $chv);
        $this->brc = new CaVMBrc($culSeaG, $culSeaS, $chm, $chv);
    }

    public function getVMStr(): CaVMCulStr
    {
        return $this->str;
    }

    public function getVMStrDes(): CaVMStrDes
    {
        return $this->std;
    }

    public function getVMSeq(): CaVMSeq
    {
        return $this->seq;
    }

    public function getVMBrc(): CaVMBrc
    {
        return $this->brc;
    }

    public function getVMTaxName(): CaVMTaxName
    {
        return $this->txn;
    }

    public function getVMStrNo(): CaVMStrNo
    {
        return $this->stn;
    }
}
