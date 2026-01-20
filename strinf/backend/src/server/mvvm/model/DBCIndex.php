<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model;

use straininfo\server\interfaces\mvvm\model\ConnectInt;
use straininfo\server\interfaces\mvvm\model\IndexIntM;
use straininfo\server\mvvm\model\dbs\ChIndReDB;
use straininfo\server\shared\cron\IndexArgs;

final class DBCIndex extends DBCRun
{
    /**
     * @var ConnectInt&IndexIntM<\straininfo\server\interfaces\mvvm\model\chan\index\IMIntEnt>
     */
    private readonly IndexIntM&ConnectInt $index;
    private static ?DBCIndex $instance = null;

    private function __construct(IndexArgs $args)
    {
        $this->index = new ChIndReDB($args);
        parent::__construct();
    }

    public static function getDBCIns(IndexArgs $args): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($args);
        }
        return self::$instance;
    }

    /** @return IndexIntM<\straininfo\server\interfaces\mvvm\model\chan\index\IMIntEnt> */
    public function getDBC(): IndexIntM
    {
        return $this->index;
    }

    protected function connect(): void
    {
        $this->index->connect();
    }

    protected function disconnect(): void
    {
        $this->index->disconnect();
    }

    protected function destroy(): void
    {
        self::$instance = null;
    }
}
