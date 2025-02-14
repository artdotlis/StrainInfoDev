<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface CaMIntArc extends MainChannel
{
    /**
     * @param array<string> $ids
     *
     * @return array<string, string>
     */
    public function getArcBySiId(array $ids): array;
}
