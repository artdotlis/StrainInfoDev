<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\query;

interface QMIntSeaIdCul extends QMIntSeaId
{
    /**
     * @param array<int> $str_ids
     *
     * @return array<int>
     */
    public function getStrId(array $str_ids): array;
}
