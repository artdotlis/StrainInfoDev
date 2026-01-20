<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model;

use straininfo\server\shared\cron\IndexArgs;

/**
 * @template T of \straininfo\server\interfaces\mvvm\model\chan\index\IMIntEnt|\straininfo\server\interfaces\mvvm\model\chan\index\IMIntEntAdd
 */
interface IndexIntM
{
    /** @return T */
    public function getIMEnt();

    public function getIDBConf(): IndexArgs;
}
