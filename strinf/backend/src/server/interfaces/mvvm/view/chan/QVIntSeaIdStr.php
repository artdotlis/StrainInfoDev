<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view\chan;

interface QVIntSeaIdStr extends QVIntSeaId
{
    /** @return array{string, bool} */
    public function getCulId(string $cul_id): array;
}
