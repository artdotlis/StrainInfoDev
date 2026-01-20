<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view;

final class StatArgs
{
    /** @param array<string> $ignore */
    public function __construct(
        private readonly bool $enabled,
        private readonly string $matomo,
        private readonly int $id,
        private readonly string $token,
        private readonly array $ignore
    ) {
    }

    public function getEnabled(): bool
    {
        return $this->enabled;
    }

    /** @return array<string> */
    public function getIgnore(): array
    {
        return $this->ignore;
    }

    public function getMatomo(): string
    {
        return $this->matomo;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getToken(): string
    {
        return $this->token;
    }
}
