<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\configs\elems;

/** @template T */
final class ConfGlRedis
{
    private string $host;
    private int $port;
    private string $socket;

    /** @param array<string, T> $arr_arg */
    public function __construct(array $arr_arg)
    {
        $key_names = [
            'host' => $this->setHost(...),
            'port' => $this->setPort(...),
            'socket' => $this->setSocket(...),
        ];
        set_conf_values($arr_arg, $key_names);
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
    private function setPort($val): bool
    {
        if (is_int($val) && $val > 0) {
            $this->port = $val;
            return true;
        }
        return false;
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
}
