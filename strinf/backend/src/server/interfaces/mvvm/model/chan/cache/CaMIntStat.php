<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface CaMIntStat extends MainChannel
{
    public function getCulPStrCnt(): string;
}
