<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\arr;

/**
 * @template K of string|int
 *
 * @param array<K, array<K, mixed>|scalar|null> $arr
 *
 * @phpstan-assert array<K, array<K, array<K, mixed>|scalar>|scalar> $arr
 *
 * @return array<K, array<K, array<K, mixed>|scalar>|scalar>
 */
function rem_null_rec(array $arr): array
{
    $res = [];
    foreach ($arr as $key => $val) {
        if (is_null($val)) {
            continue;
        }
        if (is_array($val)) {
            /** @var array<K, array<K, mixed>|scalar|null> $buf */
            $buf = $val;
            $val = [...rem_null_rec($buf)];
        }
        if (is_array($val) && !$val) {
            continue;
        }
        $res[$key] = $val;
    }
    return $res;
}
