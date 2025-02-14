<?php

declare(strict_types=1);

namespace straininfo\server\shared\logger;

/**
 * Should simulate LogLevel constants.
 */
enum LogLevE: string
{
    case EMERGENCY = 'emergency';
    case ALERT = 'alert';
    case CRITICAL = 'critical';
    case ERROR = 'error';
    case WARNING = 'warning';
    case NOTICE = 'notice';
    case INFO = 'info';
    case DEBUG = 'debug';
}
