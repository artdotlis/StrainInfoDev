<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view\chan;

interface QVIntSeaIdCul extends QVIntSeaId
{
    /** @return array{string, bool} */
    public function getStrId(string $str_id): array;
}
