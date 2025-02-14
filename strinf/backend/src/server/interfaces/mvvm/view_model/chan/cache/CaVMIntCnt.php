<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\cache;

use straininfo\server\shared\mvvm\view_model\data\QDConCnt;

interface CaVMIntCnt
{
    public function getCount(): QDConCnt;

    public function setCount(QDConCnt $cnt): void;
}
