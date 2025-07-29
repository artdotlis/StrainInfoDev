<?php

declare(strict_types=1);

namespace straininfo\server\interfaces\container;

interface RedisConf
{
    public function getHost(): string;

    public function getPort(): int;

    public function getSocket(): string;

    public function getDb(): int;
}
