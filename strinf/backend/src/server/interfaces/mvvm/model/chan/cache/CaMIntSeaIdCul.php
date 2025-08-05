<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

interface CaMIntSeaIdCul extends CaMIntSeaId
{
    /**
     * @param array<int> $str_ids
     *
     * @return array<int, string>
     */
    public function getStrId(array $str_ids): array;
}
