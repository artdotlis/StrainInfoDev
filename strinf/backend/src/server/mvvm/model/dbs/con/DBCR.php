<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\dbs\con;

use Predis;
use straininfo\server\exceptions\mvvm\model\KnownDBExc;
use straininfo\server\interfaces\container\RedisConf;
use straininfo\server\interfaces\mvvm\model\ConnectInt;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

abstract class DBCR implements ConnectInt
{
    // immutable
    private readonly RedisConf $db_conf;

    // mutable
    private Predis\Client $redis;

    public function __construct(RedisConf $args)
    {
        $this->db_conf = $args;
        $this->afterConnect(null);
    }

    public function connect(): void
    {
        try {
            $this->redis = new Predis\Client([
                'scheme' => 'redis',
                'host' => $this->db_conf->getHost(),
                'port' => $this->db_conf->getPort(),
                'database' => $this->db_conf->getDb(),
                'timeout' => 2,
            ]);
            $this->redis->connect();
        } catch (Predis\PredisException $exc) {
            throw new KnownDBExc($exc->getMessage(), LogLevE::CRITICAL, KEAct::TERM);
        }
        $this->afterConnect($this->redis);
    }

    public function disconnect(): void
    {
        $this->redis->disconnect();
        unset($this->redis);
    }

    abstract protected function afterConnect(?Predis\Client $redis): void;
}
