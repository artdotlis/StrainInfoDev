<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view_model\chan\cache;

use straininfo\server\shared\mvvm\view_model\data\QDConJson;

interface CaVMIntAll
{
    public function setResult(QDConJson $all_con): void;

    public function getResult(): QDConJson;
}
