<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller\chan;

use straininfo\server\shared\mvvm\view\api\VersionE;

interface QCIntDat
{
    /** @return array{string, bool} */
    public function getAvg(string $id, VersionE $version): array;

    /** @return array{string, bool} */
    public function getMax(string $id, VersionE $version): array;

    /** @return array{string, bool} */
    public function getMin(string $id, VersionE $version): array;
}
