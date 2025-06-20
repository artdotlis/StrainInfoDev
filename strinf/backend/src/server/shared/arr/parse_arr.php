<?php

declare(strict_types=1);

namespace straininfo\server\shared\arr;

use function Safe\preg_replace;

/**
 * @template E
 *
 * @param callable(string): E $cast
 *
 * @return array<E>
 */
function parse_str_2_arr(string $to_parse, callable $cast, int $str_len): array
{
    $parsed = array_unique(explode(',', rtrim($to_parse, ',')));
    return array_map(
        $cast,
        filter_arr(
            static fn (string $val): bool => strlen(
                preg_replace('/\s+/', '', $val)
            ) >= $str_len,
            $parsed
        )
    );
}

/**
 * @param callable(string): string $cast
 */
function parse_str_2_str(string $to_parse, callable $cast, int $str_len): string
{
    $cast_str = $cast(preg_replace('/\s+/', '', $to_parse));
    if (strlen($cast_str) >= $str_len) {
        return $cast_str;
    }
    return '';
}

/** @param array<string> $ban */
function parse_ban_str(string $arg, array $ban): string
{
    $parsed_str = $arg;
    foreach ($ban as $ban_char) {
        $parsed_str = preg_replace("/{$ban_char}/", '', $parsed_str);
    }
    return $parsed_str;
}
