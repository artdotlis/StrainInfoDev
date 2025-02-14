<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller\chan;

interface QCIntSeaStrId extends QCIntSeaId
{
    /** @return array{string, bool} */
    public function getCulId(string $cul_id): array;
}
