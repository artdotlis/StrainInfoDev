<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\con;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId;

/**
 * @template TS of CaVMIntSeaId<string>|QVMIntSeaId<string>
 */
interface ToViewIntVMSea
{
    /** @return TS */
    public function getVMStrDes(): CaVMIntSeaId|QVMIntSeaId;

    /** @return TS */
    public function getVMSeq(): CaVMIntSeaId|QVMIntSeaId;

    /** @return TS */
    public function getVMBrc(): CaVMIntSeaId|QVMIntSeaId;

    /** @return TS */
    public function getVMTaxName(): CaVMIntSeaId|QVMIntSeaId;

    /** @return TS */
    public function getVMStrNo(): CaVMIntSeaId|QVMIntSeaId;
}
