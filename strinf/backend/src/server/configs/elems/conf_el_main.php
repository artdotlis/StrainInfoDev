<?php

declare(strict_types=1);

namespace straininfo\server\configs\elems;

use Safe\Exceptions\JsonException;
use function Safe\json_encode;
use straininfo\server\exceptions\init_phase\KnownConfExc;
use straininfo\server\shared\exc\KEAct;

use straininfo\server\shared\logger\LogLevE;

/**
 * @template T
 *
 * @param array<string, T> $con_arr
 * @param array<string, callable(T|null): bool> $key_names
 */
function set_conf_values(array $con_arr, array $key_names): void
{
    $dif = array_diff(
        array_keys($key_names),
        array_keys($con_arr)
    );
    try {
        $json = json_encode($dif);
    } catch (JsonException) {
        $msg = 'Could not encode dif array as json!';
        throw new KnownConfExc($msg, LogLevE::CRITICAL, KEAct::TERM);
    }
    if (count($dif) !== 0) {
        $msg = "Missing key {$json}!";
        throw new KnownConfExc($msg, LogLevE::CRITICAL, KEAct::TERM);
    }
    foreach ($key_names as $arr_k => $arr_v) {
        $msg = "Section: {$arr_k} not defined correctly!";
        if (!$arr_v($con_arr[$arr_k] ?? null)) {
            throw new KnownConfExc($msg, LogLevE::CRITICAL, KEAct::TERM);
        }
    }
}
