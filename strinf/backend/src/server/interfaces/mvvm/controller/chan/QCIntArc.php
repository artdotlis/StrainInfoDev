<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller\chan;

interface QCIntArc
{
    /** @return array{string, bool} */
    public function getArcSiId(string $id): array;
}
