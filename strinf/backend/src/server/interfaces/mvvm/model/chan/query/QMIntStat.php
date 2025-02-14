<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\query;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface QMIntStat extends MainChannel
{
    /** @return array<string, array<int>> */
    public function getCulPStrCnt(): array;
}
