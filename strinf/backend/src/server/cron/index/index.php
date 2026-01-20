<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\cron\index;

require_once dirname(__FILE__, 2) . '/../../vendor/autoload.php';

(new SmartSearch())->start();
exit(0);
