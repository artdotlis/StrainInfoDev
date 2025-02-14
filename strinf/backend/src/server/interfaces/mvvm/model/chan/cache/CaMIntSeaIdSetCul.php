<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

interface CaMIntSeaIdSetCul extends CaMIntSeaIdSet
{
    /** @param array<int, array<int>> $str_ids */
    public function setStrId(array $str_ids): void;
}
