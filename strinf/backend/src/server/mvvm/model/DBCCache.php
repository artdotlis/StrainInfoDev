<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model;

use straininfo\server\interfaces\mvvm\model\CacheIntM;
use straininfo\server\interfaces\mvvm\model\ConnectInt;
use straininfo\server\mvvm\model\dbs\ChCacheDB;
use straininfo\server\shared\mvvm\model\CacheArgs;

final class DBCCache extends DBCRun
{
    private readonly CacheIntM&ConnectInt $cache;
    private static ?DBCCache $instance = null;

    private function __construct(CacheArgs $args)
    {
        $this->cache = new ChCacheDB($args);
        parent::__construct();
    }

    public static function getDBCIns(CacheArgs $args): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($args);
        }
        return self::$instance;
    }

    public function getDBC(): CacheIntM
    {
        return $this->cache;
    }

    protected function connect(): void
    {
        $this->cache->connect();
    }

    protected function disconnect(): void
    {
        $this->cache->disconnect();
    }

    protected function destroy(): void
    {
        self::$instance = null;
    }
}
