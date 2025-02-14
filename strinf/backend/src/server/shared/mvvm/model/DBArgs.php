<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model;

final class DBArgs
{
    public function __construct(
        private readonly string $host,
        private readonly string $db,
        private readonly string $user,
        private readonly string $password,
        private readonly string $charset,
        private readonly int $port
    ) {
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getDB(): string
    {
        return $this->db;
    }

    public function getUser(): string
    {
        return $this->user;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getPort(): int
    {
        return $this->port;
    }

    public function getCharSet(): string
    {
        return $this->charset;
    }
}
