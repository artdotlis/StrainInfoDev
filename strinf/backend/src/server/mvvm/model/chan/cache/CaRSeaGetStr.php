<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\cache\CaMIntSeaIdStr;
use straininfo\server\shared\mvvm\model\redis\RedisStE;

final class CaRSeaGetStr extends CaRSeaGet implements CaMIntSeaIdStr
{
    /**
     * @param array<int> $cul_ids
     *
     * @return array<int, array<int>>
     */
    public function getCulId(array $cul_ids): array
    {
        return $this->getEntIds($cul_ids, $this->wrId(RedisStE::CUL->value));
    }
    protected function wrId(string $id): string
    {
        return RedisStE::P_STR->value . $id . ':';
    }
}
