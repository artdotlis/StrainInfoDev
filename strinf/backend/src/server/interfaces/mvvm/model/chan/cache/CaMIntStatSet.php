<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface CaMIntStatSet extends MainChannel
{
    public function setCulPStrCnt(string $ids): void;
}
