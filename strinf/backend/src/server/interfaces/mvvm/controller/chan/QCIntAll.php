<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller\chan;

interface QCIntAll
{
    public function getAllCulIds(): string;

    public function getAllStrIds(): string;

    public function getAllTStrIds(): string;

    public function getAllTCulIds(): string;
}
