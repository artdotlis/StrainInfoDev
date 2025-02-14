<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller\chan;

interface QCIntSeaCulId extends QCIntSeaId
{
    /** @return array{string, bool} */
    public function getStrId(string $str_id): array;
}
