<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view;

use straininfo\server\interfaces\global\Url;

final class WebArgsFE implements Url
{
    /**
     * @param "https" | "http" $protocol
     */
    public function __construct(
        private readonly mixed $protocol,
        private readonly string $domain,
        private readonly int $port,
        private readonly string $site
    ) {
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

    public function getSiteMap(): string
    {
        return $this->site;
    }
}
