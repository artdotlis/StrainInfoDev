<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\arr;

/**
 * @template TK of string|int
 * @template TV
 *
 * @param array<TK, array<TV>> $arr
 */
function count_2d_arr(array $arr): int
{
    $cnt = 0;
    foreach ($arr as $el) {
        $cnt += count($el);
    }
    return $cnt;
}

/**
 * @template TK of string|int
 * @template TV of string|int
 *
 * @param array<TK, TV> $arr
 *
 * @return array<TV, int>
 */
function count_val_in_arr(array $arr): array
{
    $cnt = [];
    foreach ($arr as $val) {
        if (!array_key_exists($val, $cnt)) {
            $cnt[$val] = 0;
        }
        $cnt[$val]++;
    }
    return $cnt;
}
