<?php

declare(strict_types=1);

namespace straininfo\server\shared\exc;

enum KEAct: string
{
    case TERM = 'terminate';
    case NOTICE = 'notice';
    case WARN = 'warn';
}
