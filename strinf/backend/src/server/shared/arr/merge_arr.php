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
