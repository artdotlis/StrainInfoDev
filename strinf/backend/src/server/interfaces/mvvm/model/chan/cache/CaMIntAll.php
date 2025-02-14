<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model\chan\cache;

use straininfo\server\interfaces\mvvm\model\chan\MainChannel;

interface CaMIntAll extends MainChannel
{
    public function getAllCulIds(): string;

    public function getAllStrIds(): string;

    public function getAllTStrIds(): string;

    public function getAllTCulIds(): string;
}
