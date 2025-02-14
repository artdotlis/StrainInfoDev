<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view\chan;

interface QVIntAll
{
    public function getAllCulId(): string;

    public function getAllStrId(): string;

    public function getAllTStrId(): string;

    public function getAllTCulId(): string;
}
