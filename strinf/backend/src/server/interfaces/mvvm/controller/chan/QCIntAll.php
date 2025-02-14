<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller\chan;

interface QCIntAll
{
    public function getAllCulIds(): string;

    public function getAllStrIds(): string;

    public function getAllTStrIds(): string;

    public function getAllTCulIds(): string;
}
