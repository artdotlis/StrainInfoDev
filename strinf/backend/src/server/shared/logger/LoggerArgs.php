<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\logger;

final class LoggerArgs
{
    public function __construct(
        private readonly string $name,
        private readonly string $key,
        private readonly LogLevE $level,
        private readonly bool $bubble,
        private readonly string $r_host,
        private readonly int $r_db,
        private readonly string $r_socket,
        private readonly int $r_port,
        private readonly int $r_cap_size
    ) {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getRHost(): string
    {
        return $this->r_host;
    }

    public function getRPort(): int
    {
        return $this->r_port;
    }

    public function getRSocket(): string
    {
        return $this->r_socket;
    }

    public function getRCapSize(): int
    {
        return $this->r_cap_size;
    }

    public function getRDB(): int
    {
        return $this->r_db;
    }

    public function getLevel(): LogLevE
    {
        return $this->level;
    }

    public function getBubble(): bool
    {
        return $this->bubble;
    }
}
