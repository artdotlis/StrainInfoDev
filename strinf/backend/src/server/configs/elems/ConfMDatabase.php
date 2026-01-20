<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\configs\elems;

/** @template T */
final class ConfMDatabase
{
    private string $host;
    private string $socket;
    private string $db_name;
    private string $user;
    private string $password;
    private int $port;

    /** @param array<string, T> $arr_arg */
    public function __construct(array $arr_arg)
    {
        $key_names = [
            'host' => $this->setHost(...),
            'db' => $this->setName(...),
            'user' => $this->setUser(...),
            'password' => $this->setPassword(...),
            'port' => $this->setPort(...),
            'socket' => $this->setSocket(...),
        ];
        set_conf_values($arr_arg, $key_names);
    }

    public function getSocket(): string
    {
        return $this->socket;
    }

    public function getHost(): string
    {
        return $this->host;
    }

    public function getName(): string
    {
        return $this->db_name;
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

    /** @param T|null $val */
    private function setSocket($val): bool
    {
        if (is_string($val)) {
            $this->socket = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setHost($val): bool
    {
        if (is_string($val)) {
            $this->host = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setName($val): bool
    {
        if (is_string($val)) {
            $this->db_name = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setUser($val): bool
    {
        if (is_string($val)) {
            $this->user = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setPassword($val): bool
    {
        if (is_string($val)) {
            $this->password = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setPort($val): bool
    {
        if (is_int($val) && $val > 0) {
            $this->port = $val;
            return true;
        }
        return false;
    }
}
