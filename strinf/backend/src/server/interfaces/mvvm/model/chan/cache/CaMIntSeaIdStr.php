<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

interface CaMIntSeaIdStr extends CaMIntSeaId
{
    /**
     * @param array<int> $cul_id
     *
     * @return array<int, array<int>>
     */
    public function getCulId(array $cul_id): array;
}
