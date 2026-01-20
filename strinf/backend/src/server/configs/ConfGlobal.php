<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\configs;

use straininfo\server\configs\elems\ConfGlLogger;
use straininfo\server\configs\elems\ConfGlRedis;
use straininfo\server\configs\elems\ConfGlService;

use function straininfo\server\shared\path\get_config_root;
use function straininfo\server\shared\path\merge_path;

/** @template T */
final class ConfGlobal
{
    /** @var ConfGlService<T> */
    private readonly ConfGlService $service;

    /** @var ConfGlLogger<T> */
    private readonly ConfGlLogger $logger;

    /** @var ConfGlRedis<T> */
    private readonly ConfGlRedis $redis;

    /** @param callable(mixed): T $acc */
    public function __construct(callable $acc)
    {
        $file = merge_path(get_config_root(), ['config.local.json']);
        $conf = check_conf_values($acc, $file, 'global', ['service', 'logger', 'redis']);
        $this->service = new ConfGlService($conf['service']);
        $this->logger = new ConfGlLogger($conf['logger']);
        $this->redis = new ConfGlRedis($conf['redis']);
    }

    /** @return ConfGlService<T> */
    public function getService(): ConfGlService
    {
        return $this->service;
    }

    /** @return ConfGlLogger<T> */
    public function getLogger(): ConfGlLogger
    {
        return $this->logger;
    }

    /** @return ConfGlRedis<T> */
    public function getRedis(): ConfGlRedis
    {
        return $this->redis;
    }
}
