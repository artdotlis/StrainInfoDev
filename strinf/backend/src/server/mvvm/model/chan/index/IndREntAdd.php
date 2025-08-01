<?php

declare(strict_types=1);

namespace straininfo\server\mvvm\model\chan\index;

use straininfo\server\interfaces\mvvm\model\chan\index\IMIntEntAdd;
use straininfo\server\mvvm\model\chan\RedisMWr;
use function straininfo\server\shared\mvvm\model\create_index_array;

use function straininfo\server\shared\mvvm\model\merge_index_json;
use function straininfo\server\shared\mvvm\model\merge_index_unique_array;
use straininfo\server\shared\mvvm\view\api\IndexEntity;
use function straininfo\server\shared\text\create_slim_key_w;

final class IndREntAdd extends RedisMWr implements IMIntEntAdd
{
    private readonly string $encode;
    private readonly int $key_len;
    private readonly int $limit;

    /** @param callable(): \Predis\Client|null $dbc */
    public function __construct(
        ?callable $dbc,
        string $encode,
        int $key_len,
        int $limit
    ) {
        parent::__construct($dbc, false);
        $this->encode = $encode;
        $this->key_len = $key_len;
        $this->limit = $limit;
    }

    public function flushDB(): void
    {
        $this->getDBC()->flushdb();
    }

    /**
     * @param array{string, int, int} $res
     * @param callable(string): array<string> $split
     */
    public function addSIdsEnt(
        IndexEntity $typ,
        array $res,
        callable $split,
        bool $ignore_len
    ): void {
        $this->pushKey($typ, $res, $res[0], $ignore_len);
        if (count($keys_spl = $split($res[0])) > 1) {
            foreach ($keys_spl as $spl_key) {
                $this->pushKey($typ, $res, $spl_key, $ignore_len);
            }
        }
    }

    private function pushMatch(string $val_key, string $main_key, bool $ignore_len): void
    {
        $clean_key = $main_key;
        $val_len = 0;
        $main_len = strlen($main_key);
        $start = $this->getMinLen($ignore_len);
        if ($val_key !== '') {
            $clean_key .= ':' . $val_key;
            $val_len = strlen($val_key) + 1;
            $start = min($this->getMinLen($ignore_len), $main_len + 1);
        }
        for ($off = $start; $off < $main_len + $val_len; $off++) {
            $key = substr($clean_key, 0, $off);
            if ($off === $main_len + 1) {
                continue;
            }
            $pre_res = $this->getDBC()->hget($key, '__match') ?: '';
            $this->getDBC()->hset(
                $key,
                '__match',
                merge_index_unique_array(
                    $pre_res,
                    $off > $main_len ? $val_key : $clean_key,
                    $this->limit
                )
            );
        }
    }

    private function getMinLen(bool $ignore_len): int
    {
        if ($ignore_len) {
            return 1;
        }
        return $this->key_len;
    }

    /** @param array{string, int, int} $res */
    private function pushKey(
        IndexEntity $typ,
        array $res,
        string $id_key,
        bool $ignore_len
    ): void {
        [$full_key, $first_strain, $relation_size] = $res;
        $slim_key = create_slim_key_w($id_key, $this->encode);
        $main_key = $slim_key['key'];
        $val_key = $slim_key['value'];
        if (strlen($main_key) + strlen($val_key) >= $this->getMinLen($ignore_len)) {
            $suf = $val_key === '' ? '' : ':' . $val_key;
            $mer_key = $main_key . $suf;
            $pre_res = $this->getDBC()->hget($mer_key, '__main') ?: '';
            $this->getDBC()->hset($mer_key, '__main', merge_index_json(
                $pre_res,
                create_index_array($full_key, $typ, $first_strain, $relation_size),
                $this->limit
            ));
            $this->pushMatch($val_key, $main_key, $ignore_len);
        }
    }
}
