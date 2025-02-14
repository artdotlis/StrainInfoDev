<?php

declare(strict_types=1);

namespace straininfo\server\shared\arr;

/**
 * @template TV
 *
 * @template TK of string|int
 *
 * @param array<TK, TV> $dict
 *
 * @param callable(TV): bool $filter
 *
 * @return array<TK, TV>
 */
function filter_arr(callable $filter, array $dict): array
{
    /** @var array<TK, TV> $res */
    $res = [];
    foreach ($dict as $key => $ele) {
        if ($filter($ele)) {
            $res[$key] = $ele;
        }
    }
    return $res;
}

/**
 * @template TV
 *
 * @template TK of string|int
 *
 * @param array<TK, TV|null> $dict
 *
 * @param callable(TV): bool $filter
 *
 * @return array<TK, TV>
 */
function filter_arr_no_null(callable $filter, array $dict): array
{
    $res = [];
    foreach ($dict as $key => $ele) {
        if (!is_null($ele) && $filter($ele)) {
            $res[$key] = $ele;
        }
    }
    return $res;
}
