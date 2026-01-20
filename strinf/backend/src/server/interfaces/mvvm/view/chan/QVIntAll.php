<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\view\chan;

interface QVIntAll
{
    public function getAllCulId(): string;

    public function getAllStrId(): string;

    public function getAllTStrId(): string;

    public function getAllTCulId(): string;
}
