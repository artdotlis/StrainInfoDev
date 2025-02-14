<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface CaMIntArcSet extends MainChannel
{
    /** @param array<string, string> $data */
    public function setArcBySiId(array $data): void;
}
