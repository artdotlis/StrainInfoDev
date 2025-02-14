<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface CaMIntAllSet extends MainChannel
{
    public function setAllCulIds(string $ids, int $cnt): void;

    public function setAllStrIds(string $ids, int $cnt): void;

    public function setAllTStrIds(string $ids, int $cnt): void;

    public function setAllTCulIds(string $ids, int $cnt): void;
}
