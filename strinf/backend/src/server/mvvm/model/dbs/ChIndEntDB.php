<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\dbs;

use straininfo\server\interfaces\mvvm\model\DBIntEntM;
use straininfo\server\mvvm\model\chan\sia\QPEnt;
use straininfo\server\mvvm\model\dbs\con\DBCM;
use straininfo\server\shared\mvvm\model\DBArgs;

final class ChIndEntDB extends DBCM implements DBIntEntM
{
    private readonly DBArgs $db_conf;

    private QPEnt $q_ent;

    public function __construct(DBArgs $args)
    {
        $this->db_conf = $args;
        parent::__construct($args);
    }

    public function getQDBConf(): DBArgs
    {
        return $this->db_conf;
    }

    public function getQDBEnt(): QPEnt
    {
        return $this->q_ent;
    }
    /** @param callable(): \PDO|null $pdo */
    protected function afterConnect(?callable $pdo): void
    {
        $this->q_ent = new QPEnt($pdo);
    }
}
