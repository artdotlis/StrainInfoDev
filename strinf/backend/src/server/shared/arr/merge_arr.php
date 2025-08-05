<?php

declare(strict_types=1);

namespace straininfo\server\shared\arr;

/**
 * @template TV
 * @template TK of string|int
 *
 * @param array<int, TK> $keys
 * @param array<int, TV> $values
 *
 * @return array<TK, TV>
 */
function merge_2d_arr(array $keys, array $values): array
{
    /** @var array<TK, TV> $res */
    $res = [];
    foreach ($keys as $ind => $key) {
        if (array_key_exists($ind, $values)) {
            $res[$key] = $values[$ind];
        }
    }
    return $res;
}

/**
 * @template T of string|int
 *
 * @param array<T, array<string|int>> $first
 * @param array<T, string> $second
 *
 * @return array<string>
 */
function arr_merge_2_set(array $first, array $second): array
{
    $res = [];
    foreach ($first as $arr_el) {
        foreach ($arr_el as $str_el) {
            $res[(string) $str_el] = 1;
        }
    }
    foreach ($second as $arr_str) {
        foreach (explode(',', $arr_str) as $str_el) {
            $res[$str_el] = 1;
        }
    }
    return array_keys($res);
}
