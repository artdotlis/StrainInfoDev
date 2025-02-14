<?php

declare(strict_types=1);

namespace straininfo\server\shared\cron;

use straininfo\server\interfaces\container\RedisConf;

final class IndexArgs implements RedisConf
{
    public function __construct(
        private readonly string $host,
        private readonly int $port,
        private readonly int $db,
        private readonly string $charset,
        private readonly int $key_len,
        private readonly int $limit
    ) {
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getDb(): int
    {
        return $this->db;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getKeyLen(): int
    {
        return $this->key_len;
    }

    public function getCharSet(): string
    {
        return $this->charset;
    }
}
