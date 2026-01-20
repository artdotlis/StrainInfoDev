<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\configs;

use straininfo\server\configs\elems\ConfVStat;
use straininfo\server\configs\elems\ConfVWebBE;
use straininfo\server\configs\elems\ConfVWebFE;

use function straininfo\server\shared\path\get_config_root;
use function straininfo\server\shared\path\merge_path;

/** @template T */
final class ConfView
{
    /** @var ConfVWebBE<T> */
    private readonly ConfVWebBE $web_be;

    /** @var ConfVWebFE<T> */
    private readonly ConfVWebFE $web_fe;

    /** @var ConfVStat<T> */
    private readonly ConfVStat $statistic;

    /** @param callable(mixed): T $acc */
    public function __construct(callable $acc)
    {
        $file = merge_path(get_config_root(), ['config.local.json']);
        $conf_be = check_conf_values($acc, $file, 'backend', ['web', 'statistic']);
        $conf_fe = check_conf_values($acc, $file, 'frontend', ['web']);
        $this->web_be = new ConfVWebBE($conf_be['web']);
        $this->web_fe = new ConfVWebFE($conf_fe['web']);
        $this->statistic = new ConfVStat($conf_be['statistic']);
    }

    /** @return ConfVWebBE<T> */
    public function getWebBE(): ConfVWebBE
    {
        return $this->web_be;
    }

    /** @return ConfVWebFE<T> */
    public function getWebFE(): ConfVWebFE
    {
        return $this->web_fe;
    }

    /** @return ConfVStat<T> */
    public function getStat(): ConfVStat
    {
        return $this->statistic;
    }
}
