<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

interface CaMIntSeaIdStr extends CaMIntSeaId
{
    /**
     * @param array<int> $cul_id
     *
     * @return array<int, string>
     */
    public function getCulId(array $cul_id): array;
}
