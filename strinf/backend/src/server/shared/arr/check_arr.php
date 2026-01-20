<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\arr;

use function straininfo\server\shared\types\parse_int;

/**
 * @template E
 *
 * @param array<string, E> $arr
 */
function check_kt_int(array $arr, string $key): ?int
{
    if (key_exists($key, $arr) && is_numeric($arr[$key])) {
        return (int) $arr[$key];
    }
    return null;
}

/**
 * @template E
 *
 * @param array<string, E> $arr
 */
function check_kt_str(array $arr, string $key): ?string
{
    if (key_exists($key, $arr) && is_string($arr[$key])) {
        return $arr[$key];
    }
    return null;
}

/**
 * @template E
 *
 * @param array<string, E> $arr
 */
function check_kt_f_str(array $arr, string $key): ?string
{
    if (key_exists($key, $arr) && is_string($arr[$key]) && $arr[$key] !== '') {
        return $arr[$key];
    }
    return null;
}

/**
 * @template E
 *
 * @param array<string, E> $arr
 * @param non-empty-string $sep
 *
 * @return ?array<string>
 */
function check_kt_f_arr_str(array $arr, string $key, string $sep): ?array
{
    if (key_exists($key, $arr) && is_string($arr[$key]) && $arr[$key] !== '') {
        $arr = array_values(array_filter(
            array_map(
                static fn (string $val) => trim($val),
                explode($sep, $arr[$key])
            ),
            static fn (string $val) => $val !== ''
        ));
        if (count($arr) === 0) {
            return null;
        }
        return $arr;
    }
    return null;
}

/**
 * @template E
 *
 * @param array<string, E> $arr
 * @param non-empty-string $sep
 *
 * @return ?array<positive-int>
 */
function check_kt_f_arr_id(array $arr, string $key, string $sep): ?array
{
    if (key_exists($key, $arr) && is_string($arr[$key]) && $arr[$key] !== '') {
        $arr = array_values(array_filter(
            array_map(
                static fn (string $val) => (int) trim($val),
                explode($sep, $arr[$key])
            ),
            static fn (int $val) => $val > 0
        ));
        if (count($arr) === 0) {
            return null;
        }
        return $arr;
    }
    return null;
}

/**
 * @template E
 *
 * @param array<string, E> $arr
 */
function check_kt_bool(array $arr, string $key): ?bool
{
    if (
        key_exists($key, $arr)
        && (is_bool($arr[$key]) || is_numeric($arr[$key]))
    ) {
        return (bool) (int) $arr[$key];
    }
    return null;
}

/**
 * @template E
 *
 * @param array<string, E> $arr
 */
function check_kt_false_bool(array $arr, string $key): bool
{
    if (
        key_exists($key, $arr)
        && (is_bool($arr[$key]) || is_numeric($arr[$key]))
    ) {
        return (bool) (int) $arr[$key];
    }
    return false;
}
/**
 * @template E
 *
 * @param array<string, E> $arr
 */
function check_kt_true(array $arr, string $key): null | true
{
    if (
        key_exists($key, $arr) &&
        (is_bool($arr[$key]) || is_numeric($arr[$key])) && (bool) (int) $arr[$key]
    ) {
        return true;
    }
    return null;
}

/**
 * @template E
 *
 * @param array<string, E> $arr
 *
 * @return non-empty-array<positive-int>|null
 */
function check_kt_arr_id(array $arr, string $key): ?array
{
    if (key_exists($key, $arr) && is_array($arr[$key])) {
        $arr = [...array_values(array_filter(
            array_map(
                parse_int(...),
                $arr[$key]
            ),
            static fn (int $val) => $val > 0
        )),
        ];
        if (count($arr) === 0) {
            return null;
        }
        return $arr;
    }
    return null;
}
