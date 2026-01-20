<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\controller;

use Slim\App;
use straininfo\server\interfaces\global\Runnable;

interface CtrlIntBoot extends Runnable
{
    public function run(): void;

    public function setMaintenance(?\DateTime $finish_time, bool $mnt): void;
    /** @return App<\Psr\Container\ContainerInterface|null> */
    public function getApp(): App;
}
