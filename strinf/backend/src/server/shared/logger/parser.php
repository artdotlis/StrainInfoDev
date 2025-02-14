<?php

declare(strict_types=1);

namespace straininfo\server\shared\logger;

function parse_lle(string $val): LogLevE
{
    foreach (LogLevE::cases() as $case) {
        if ($case->value === $val) {
            return $case;
        }
    }
    return LogLevE::NOTICE;
}
