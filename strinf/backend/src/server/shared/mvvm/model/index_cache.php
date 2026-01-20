<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model;

use function Safe\json_decode;
use function Safe\json_encode;
use straininfo\server\exceptions\mvvm\model\KnownDBExc;
use straininfo\server\shared\exc\KEAct;

use straininfo\server\shared\logger\LogLevE;
use straininfo\server\shared\mvvm\view\api\IndexEntity;

/**
 * @return array{t: int<0, 4>, k: string, s: int, c: int}
 */
function create_index_array(
    string $key,
    IndexEntity $typ,
    int $first_strain,
    int $relation_size
): array {
    return [
        't' => $typ->value,
        'k' => $key,
        's' => $first_strain,
        'c' => $relation_size,
    ];
}

/**
 * @template T
 *
 * @param T $dec
 *
 * @return array{string,int<0,4>,int,int}
 */
function decode_json_elem($dec): array
{
    if (
        !(is_object($dec) &&
        property_exists($dec, 'k') &&
        property_exists($dec, 't') &&
        property_exists($dec, 's') &&
        property_exists($dec, 'c'))
    ) {
        throw new KnownDBExc('Index JSON is malformed!', LogLevE::CRITICAL, KEAct::WARN);
    }
    return [
        $dec->k, // @phpstan-ignore property.notFound
        $dec->t, // @phpstan-ignore property.notFound
        $dec->s, // @phpstan-ignore property.notFound
        $dec->c, // @phpstan-ignore property.notFound
    ];
}

/** @return array<array{string,int<0,4>,int,int}> */
function decode_json_array(string $to_dec): array
{
    $dec = json_decode($to_dec);
    if (!is_array($dec)) {
        throw new KnownDBExc('Index JSON is malformed!', LogLevE::CRITICAL, KEAct::WARN);
    }
    $res = [];
    foreach ($dec as $dec_elem) {
        $res[] = decode_json_elem($dec_elem);
    }
    return $res;
}

/**
 * @template T
 *
 * @param array<T> $previous
 * @param array{t: int<0, 4>, k: string, s: int, c: int} $current
 *
 * @return array<array<string, int|string>|T>
 */
function create_new_array(array $previous, array $current, int $limit): array
{
    if ($limit === 0) {
        return [...$previous, $current];
    }
    $count = array_reduce(
        $previous,
        static function (int $carry, $con) use ($current): int {
            if (
                is_object($con) &&
                property_exists($con, 't') &&
                $con->t === $current['t'] // @phpstan-ignore property.notFound
            ) {
                return $carry + 1;
            }
            return $carry;
        },
        0
    );
    if ($limit > $count) {
        return [...$previous, $current];
    }
    return $previous;
}

/**
 * @param array{t: int<0, 4>, k: string, s: int, c: int} $new_elem
 */
function merge_index_json(string $container, array $new_elem, int $limit): string
{
    if ($container !== '' && is_array($prev_array = json_decode($container))) {
        return json_encode(create_new_array(
            $prev_array,
            $new_elem,
            $limit
        ));
    }
    return json_encode([$new_elem]);
}

function merge_index_unique_array(string $container, string $new_key, int $limit): string
{
    if (
        $container !== '' && is_array($prev_array = json_decode($container))
        && array_is_list($prev_array)
    ) {
        $min_len = min(1_000_000, ...array_map(
            static fn ($val) => strlen((string) $val),
            $prev_array
        ));
        $new_len = strlen($new_key);
        if ($new_len === $min_len) {
            $prev_array[] = $new_key;
        } elseif ($new_len < $min_len) {
            usort(
                $prev_array,
                static fn ($fir, $sec) => strlen((string) $fir) - strlen((string) $sec)
            );
            $prev_array = [
                $new_key,
                ...array_slice($prev_array, 0, $limit - 1),
            ];
        }
        $uniq = array_unique($prev_array);
        return json_encode($uniq);
    }
    return json_encode([$new_key]);
}

/** @return array<string> */
function parse_index_match(string $container): array
{
    if (
        $container !== '' && is_array($match = json_decode($container))
        && array_is_list($match)
    ) {
        return $match;
    }
    return [];
}

/**
 * @param array{match: array<string>, exact: string} $results
 *
 * @return array{match: array<array{string,int<0, 4>,int,int}>, exact: array<array{string,int<0, 4>,int,int}>}
 */
function parse_index_results(array $results): array
{
    $exact = [];
    if ($results['exact'] !== '') {
        $exact = decode_json_array($results['exact']);
    }
    $match = [];
    foreach ($results['match'] as $val) {
        array_push($match, ...decode_json_array($val));
    }
    return [
        'exact' => $exact,
        'match' => $match,
    ];
}
