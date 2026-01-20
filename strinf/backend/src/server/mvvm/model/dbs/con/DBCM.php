<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\mvvm\model\dbs\con;

use straininfo\server\interfaces\mvvm\model\ConnectInt;
use function straininfo\server\shared\dbs\tryToConnect;

use straininfo\server\shared\mvvm\model\DBArgs;

abstract class DBCM implements ConnectInt
{
    private \PDO $pdo;
    private readonly DBArgs $db_conf;
    private int $last_call;

    public function __construct(DBArgs $args)
    {
        $this->db_conf = $args;
        $this->afterConnect(null);
        $this->last_call = time() - 86400;
    }

    public function connect(): void
    {
        tryToConnect($this->create_connection(...), 10);
        $this->afterConnect(function (): \PDO {
            $cur = time();
            if ($cur - $this->last_call > 300) {
                $this->create_connection();
            }
            $this->last_call = $cur;
            return $this->pdo;
        });
    }

    public function disconnect(): void
    {
        unset($this->pdo);
    }

    /** @param callable(): \PDO|null $pdo */
    abstract protected function afterConnect(?callable $pdo): void;

    protected function createDSN(): string
    {
        $host = $this->db_conf->getHost();
        $db = $this->db_conf->getDB();
        $port = $this->db_conf->getPort();
        $dsn = 'mysql:';
        if ($this->db_conf->getSocket() !== '') {
            $socket = $this->db_conf->getSocket();
            $dsn .= "unix_socket={$socket};";
        } else {
            $dsn .= "host={$host};port={$port};";
        }
        $dsn .= "dbname={$db};";
        $char = str_replace('-', '', $this->db_conf->getCharSet());
        return $dsn . "charset={$char}";
    }

    private function tcp_socket_connection(): void
    {
        $this->pdo = new \PDO(
            $this->createDSN(),
            $this->db_conf->getUser(),
            $this->db_conf->getPassword(),
            [
                \PDO::ATTR_TIMEOUT => 86400,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            ]
        );
    }

    private function create_connection(): void
    {
        try {
            if ($this->pdo->query('SELECT 1;') === false) {
                $this->tcp_socket_connection();
            }
        } catch (\Throwable) {
            $this->tcp_socket_connection();
        }
    }
}
