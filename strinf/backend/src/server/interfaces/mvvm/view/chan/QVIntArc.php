<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view\chan;

interface QVIntArc
{
    /** @return array{string, bool} */
    public function getArcSiId(string $id): array;
}
