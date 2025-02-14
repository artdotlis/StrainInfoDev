<?php

declare(strict_types=1);

namespace straininfo\server\shared\arr;

/**
 * @template T of string|int
 *
 * @param array<string|int> $arr
 * @param callable(string): T $cast
 *
 * @return array<T>
 */
function arr_2_set(array $arr, callable $cast): array
{
    $res = [];
    foreach ($arr as $str_el) {
        $res[(string) $str_el] = 1;
    }
    return array_map($cast, array_keys($res));
}

/**
 * @template T of string|int
 * @template E of string|int
 *
 * @param array<T, array<E>> $arr
 *
 * @return array<E>
 */
function arr_merge_2_set(array $arr): array
{
    $res = [];
    foreach ($arr as $arr_el) {
        foreach ($arr_el as $str_el) {
            $res[$str_el] = 1;
        }
    }
    return array_keys($res);
}
