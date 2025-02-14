<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model;

use straininfo\server\interfaces\mvvm\model\ConnectInt;
use straininfo\server\interfaces\mvvm\model\DBIntM;
use straininfo\server\mvvm\model\dbs\ChMainDB;
use straininfo\server\shared\mvvm\model\DBArgs;

final class DBCData extends DBCRun
{
    /**
     * @var DBIntM<array<string, object>, array<string, object>>&ConnectInt
     */
    private readonly DBIntM&ConnectInt $data;
    private static ?DBCData $instance = null;

    private function __construct(DBArgs $args)
    {
        /** @var ChMainDB<array<string, object>, array<string, object>> $tmp */
        $tmp = new ChMainDB($args);
        $this->data = $tmp;
        parent::__construct();
    }

    public static function getDBCIns(DBArgs $args): self
    {
        if (is_null(self::$instance)) {
            self::$instance = new self($args);
        }
        return self::$instance;
    }

    /**
     * @return DBIntM<array<string, object>, array<string, object>>
     */
    public function getDBC(): DBIntM
    {
        return $this->data;
    }

    protected function connect(): void
    {
        $this->data->connect();
    }

    protected function disconnect(): void
    {
        $this->data->disconnect();
    }

    protected function destroy(): void
    {
        self::$instance = null;
    }
}
