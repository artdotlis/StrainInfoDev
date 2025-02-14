<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\query;

interface QVMIntCnt
{
    public function getCount(): int;

    public function createJson(int $cnt): string;
}
