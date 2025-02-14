<?php

declare(strict_types=1);

namespace straininfo\server\configs;

use straininfo\server\configs\elems\ConfMCache;
use straininfo\server\configs\elems\ConfMDatabase;
use straininfo\server\configs\elems\ConfMIndex;

use function straininfo\server\shared\path\get_config_root;
use function straininfo\server\shared\path\merge_path;

/** @template T */
final class ConfModel
{
    /** @var ConfMDatabase<T> */
    private readonly ConfMDatabase $database;

    /** @var ConfMCache<T> */
    private readonly ConfMCache $cache;

    /** @var ConfMIndex<T> */
    private readonly ConfMIndex $index;

    /** @param callable(mixed): T $acc */
    public function __construct(callable $acc)
    {
        $file = merge_path(get_config_root(), ['config.local.json']);
        $conf = check_conf_values($acc, $file, 'model', ['database', 'cache', 'index']);
        $this->database = new ConfMDatabase($conf['database']);
        $this->cache = new ConfMCache($conf['cache']);
        $this->index = new ConfMIndex($conf['index']);
    }

    /** @return ConfMDatabase<T> */
    public function getDatabase(): ConfMDatabase
    {
        return $this->database;
    }

    /** @return ConfMCache<T> */
    public function getCache(): ConfMCache
    {
        return $this->cache;
    }

    /** @return ConfMIndex<T> */
    public function getIndex(): ConfMIndex
    {
        return $this->index;
    }
}
