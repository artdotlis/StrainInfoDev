<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\global;

interface Url
{
    public function getDomain(): string;

    /** @return "https" | "http" */
    public function getProtocol(): mixed;

    public function getPort(): int;
}
