<?php

declare(strict_types=1);

namespace straininfo\server\configs\elems;

/** @template T */
final class ConfMIndex
{
    private int $db_name;
    private int $key_len;
    private int $limit;

    /** @param array<string, T> $arr_arg */
    public function __construct(array $arr_arg)
    {
        $key_names = [
            'db' => $this->setName(...),
            'key_len' => $this->setKeyLen(...),
            'limit' => $this->setLimit(...),
        ];
        set_conf_values($arr_arg, $key_names);
    }

    public function getName(): int
    {
        return $this->db_name;
    }

    public function getLimit(): int
    {
        return $this->limit;
    }

    public function getKeyLen(): int
    {
        return $this->key_len;
    }

    /** @param T|null $val */
    private function setName($val): bool
    {
        if (is_int($val) && $val > 0) {
            $this->db_name = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setLimit($val): bool
    {
        if (is_int($val) && $val >= 0) {
            $this->limit = $val;
            return true;
        }
        return false;
    }

    /** @param T|null $val */
    private function setKeyLen($val): bool
    {
        if (is_int($val) && $val > 0) {
            $this->key_len = $val;
            return true;
        }
        return false;
    }
}
