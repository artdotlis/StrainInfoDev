<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\dbs\con;

use straininfo\server\interfaces\container\RedisConf;
use straininfo\server\interfaces\mvvm\model\ConnectInt;

use function straininfo\server\shared\dbs\tryToConnect;

abstract class DBCR implements ConnectInt
{
    // immutable
    private readonly RedisConf $db_conf;

    // mutable
    private \Redis $redis;
    private int $last_call;

    public function __construct(RedisConf $args)
    {
        $this->db_conf = $args;
        $this->afterConnect(null);
        $this->last_call = time() - 86400;
    }

    public function connect(): void
    {
        tryToConnect($this->create_connection(...), 10);
        $this->afterConnect(function (): \Redis {
            $cur = time();
            if ($cur - $this->last_call > 300) {
                $this->create_connection();
            }
            $this->last_call = $cur;
            return $this->redis;
        });
    }

    public function disconnect(): void
    {
        $this->redis->close();
        unset($this->redis);
    }

    /** @param callable(): \Redis|null $redis */
    abstract protected function afterConnect(?callable $redis): void;

    private function socket_connection(): void
    {
        [$host, $port] = [$this->db_conf->getSocket(), -1];
        $this->redis = new \Redis();
        $this->redis->connect($host, $port, 2, null, 0, 86400.0, null);
        $this->redis->select($this->db_conf->getDb());
    }

    private function tcp_connection(): void
    {
        [$host, $port] = [$this->db_conf->getHost(),  $this->db_conf->getPort()];
        $this->redis = new \Redis();
        $this->redis->connect($host, $port, 2, null, 0, 86400.0, null);
        $this->redis->select($this->db_conf->getDb());
    }

    private function create_connection(): void
    {
        try {
            $this->redis->ping();
        } catch (\Throwable $ex) {
            if ($this->db_conf->getSocket() !== '') {
                $this->socket_connection();
            } else {
                $this->tcp_connection();
            }
        }
    }
}
