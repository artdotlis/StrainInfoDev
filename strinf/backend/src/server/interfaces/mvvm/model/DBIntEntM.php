<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\interfaces\mvvm\model;

use straininfo\server\interfaces\mvvm\model\chan\query\QMIntEnt;
use straininfo\server\shared\mvvm\model\DBArgs;

interface DBIntEntM
{
    public function getQDBEnt(): QMIntEnt;

    public function getQDBConf(): DBArgs;
}
