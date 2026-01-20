<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view;

use straininfo\server\interfaces\global\Url;

final class WebArgsBE implements Url
{
    /**
     * @param array<string> $cors
     * @param array<string> $private
     * @param "http" | "https" $protocol
     */
    public function __construct(
        private readonly string $charset,
        private readonly array $cors,
        private readonly array $private,
        private readonly mixed $protocol,
        private readonly string $domain,
        private readonly int $port
    ) {
    }

    /** @return array<string> */
    public function getCORS(): array
    {
        return $this->cors;
    }

    /** @return array<string> */
    public function getPrivate(): array
    {
        return $this->private;
    }

    public function getCharSet(): string
    {
        return $this->charset;
    }

    /** @return "http" | "https" */
    public function getProtocol(): mixed
    {
        return $this->protocol;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getPort(): int
    {
        return $this->port;
    }
}
