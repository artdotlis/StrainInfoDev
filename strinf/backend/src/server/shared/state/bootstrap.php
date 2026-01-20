<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\state;

use straininfo\server\Bootstrap;

function reboot(Bootstrap $boot): Bootstrap
{
    $boot->stop();
    $new_boot = Bootstrap::getBootstrap();
    $new_boot->init(false);
    return $new_boot;
}
