<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model;

use straininfo\server\interfaces\container\RedisConf;

final class CacheArgs implements RedisConf
{
    public function __construct(
        private readonly string $host,
        private readonly int $port,
        private readonly string $socket,
        private readonly int $db,
        private readonly string $charset,
        private readonly int $expire_h,
        private readonly int $tmp_h,
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

    public function getSocket(): string
    {
        return $this->socket;
    }

    public function getDb(): int
    {
        return $this->db;
    }

    public function getCharSet(): string
    {
        return $this->charset;
    }

    public function getExH(): int
    {
        return $this->expire_h;
    }

    public function getTmpH(): int
    {
        return $this->tmp_h;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }
}
