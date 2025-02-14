<?php

declare(strict_types=1);

namespace straininfo\server\shared\state;

enum RunState: string
{
    case RUNNING = 'is running!';
    case MAINTENANCE = 'is under maintenance!';
    case NOT_RUNNING = 'is not Running!';
    case STOPPED = 'is stopped!';
}
