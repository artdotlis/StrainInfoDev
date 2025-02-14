<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\con;

use straininfo\server\interfaces\mvvm\view_model\chan\cache\CaVMIntSeaId;
use straininfo\server\interfaces\mvvm\view_model\chan\query\QVMIntSeaId;

/**
 * @template TI of CaVMIntSeaId<int>|QVMIntSeaId<int>
 * @template TS of CaVMIntSeaId<string>|QVMIntSeaId<string>
 *
 * @extends ToViewIntVMSea<TS>
 */
interface ToViewIntVMSeaStr extends ToViewIntVMSea
{
    /** @return TI */
    public function getVMCul(): CaVMIntSeaId|QVMIntSeaId;
}
