<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model;

interface ConnectInt
{
    public function disconnect(): void;

    public function connect(): void;
}
