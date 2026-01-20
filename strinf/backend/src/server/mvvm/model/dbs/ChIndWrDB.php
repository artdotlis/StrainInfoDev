<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\dbs;

use straininfo\server\interfaces\mvvm\model\IndexIntM;
use straininfo\server\mvvm\model\chan\index\IndREntAdd;
use straininfo\server\mvvm\model\dbs\con\DBCR;
use straininfo\server\shared\cron\IndexArgs;

/**
 * @implements IndexIntM<IndREntAdd>
 */
final class ChIndWrDB extends DBCR implements IndexIntM
{
    // immutable
    private readonly IndexArgs $db_conf;

    // mutable
    private IndREntAdd $ca_ind;

    public function __construct(IndexArgs $args)
    {
        $this->db_conf = $args;
        parent::__construct($args);
    }

    public function getIMEnt(): IndREntAdd
    {
        return $this->ca_ind;
    }

    public function getIDBConf(): IndexArgs
    {
        return $this->db_conf;
    }

    /** @param callable(): \Redis|null $redis */
    protected function afterConnect(?callable $redis): void
    {
        $this->ca_ind = new IndREntAdd(
            $redis,
            $this->getIDBConf()->getCharSet(),
            $this->getIDBConf()->getKeyLen(),
            $this->getIDBConf()->getLimit()
        );
    }
}
