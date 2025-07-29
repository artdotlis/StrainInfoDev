<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\dbs\con;

use straininfo\server\shared\mvvm\model\DBArgs;
use straininfo\server\shared\logger\LogLevE;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\interfaces\mvvm\model\ConnectInt;
use straininfo\server\exceptions\mvvm\model\KnownDBExc;

abstract class DBCM implements ConnectInt
{
    private \PDO $pdo;
    private readonly DBArgs $db_conf;

    public function __construct(DBArgs $args)
    {
        $this->db_conf = $args;
        $this->afterConnect(null);
    }

    public function connect(): void
    {
        try {
            $this->pdo = new \PDO(
                $this->createDSN(),
                $this->db_conf->getUser(),
                $this->db_conf->getPassword(),
                [
                    \PDO::ATTR_TIMEOUT => 2,
                    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                ]
            );
        } catch (\PDOException $exc) {
            throw new KnownDBExc($exc->getMessage(), LogLevE::CRITICAL, KEAct::TERM);
        }
        $this->afterConnect($this->pdo);
    }

    public function disconnect(): void
    {
        unset($this->pdo);
    }

    abstract protected function afterConnect(?\PDO $pdo): void;

    protected function createDSN(): string
    {
        $host = $this->db_conf->getHost();
        $db = $this->db_conf->getDB();
        $port = $this->db_conf->getPort();
        $dsn = "mysql:";
        if ($this->db_conf->getSocket() !== "") {
            $socket = $this->db_conf->getSocket();
            $dsn .= "unix_socket={$socket};";
        } else {
            $dsn .= "host={$host};port={$port};";
        }
        $dsn .= "dbname={$db};";
        // TODO: add better converter from mb_encoding strings
        $char = str_replace('-', '', $this->db_conf->getCharSet());
        return $dsn . "charset={$char}";
    }
}
