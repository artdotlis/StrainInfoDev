<?php

declare(strict_types=1);

namespace straininfo\server\shared\dbs;

use straininfo\server\exceptions\mvvm\model\KnownDBExc;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LogLevE;

/** @param callable(): void $connect */
function tryToConnect(callable $connect, int $retries): void
{
    $to_connect = true;
    $cnt = 0;
    while ($cnt <= $retries && $to_connect) {
        try {
            $connect();
            $to_connect = false;
        } catch (\Throwable) {
            $cnt += 1;
            sleep(6);
        }
    }
    if ($to_connect) {
        throw new KnownDBExc(
            'Could not establish connection',
            LogLevE::CRITICAL,
            KEAct::TERM
        );
    }
}
