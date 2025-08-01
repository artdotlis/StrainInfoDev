<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\dbs\con;

use straininfo\server\interfaces\mvvm\model\ConnectInt;
use straininfo\server\interfaces\container\RedisConf;
use function straininfo\server\shared\dbs\tryToConnect;

use Predis;

abstract class DBCR implements ConnectInt
{
    // immutable
    private readonly RedisConf $db_conf;

    // mutable
    private Predis\Client $redis;
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
        $this->afterConnect(function (): \Predis\Client {
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
        $this->redis->disconnect();
        unset($this->redis);
    }

    /** @param callable(): \Predis\Client|null $redis */
    abstract protected function afterConnect(?callable $redis): void;

    private function socket_connection(): void
    {
        $this->redis = new Predis\Client([
            'scheme' => 'unix',
            'path' => $this->db_conf->getSocket(),
            'database' => $this->db_conf->getDb(),
            'timeout' => 86400,
        ]);
    }

    private function tcp_connection(): void
    {
        $this->redis = new Predis\Client([
            'scheme' => 'tcp',
            'host' => $this->db_conf->getHost(),
            'port' => $this->db_conf->getPort(),
            'database' => $this->db_conf->getDb(),
            'timeout' => 86400,
        ]);
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
