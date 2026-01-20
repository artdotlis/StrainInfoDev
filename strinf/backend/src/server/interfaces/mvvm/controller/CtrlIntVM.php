<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller;

interface CtrlIntVM
{
    public function getViewCharSet(): string;

    public function setMaintenanceV(?\DateTime $finish_time): void;
}
