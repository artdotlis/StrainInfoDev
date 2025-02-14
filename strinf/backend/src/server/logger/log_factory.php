<?php

declare(strict_types=1);

namespace straininfo\server\logger;

use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\RedisHandler;
use Monolog\Level;
use Monolog\Logger;
use Predis;
use Psr\Log\LoggerInterface;
use straininfo\server\exceptions\logger\KnownLoggerExc;
use function straininfo\server\shared\dbs\tryToConnect;
use straininfo\server\shared\exc\KEAct;
use straininfo\server\shared\logger\LoggerArgs;

use straininfo\server\shared\logger\LogLevE;

function parse_log_level(LogLevE $level): Level
{
    return match ($level) {
        LogLevE::DEBUG => Level::Debug,
        LogLevE::INFO => Level::Info,
        LogLevE::NOTICE => Level::Notice,
        LogLevE::WARNING => Level::Warning,
        LogLevE::ERROR => Level::Error,
        LogLevE::CRITICAL => Level::Critical,
        LogLevE::ALERT => Level::Alert,
        default => Level::Emergency,
    };
}

function create_logger(LoggerArgs $args, int $tries = 1): LoggerInterface
{
    $logger = new Logger($args->getName());
    $handler = new RedisHandler(
        create_log_redis_c($args, $tries),
        $args->getKey(),
        parse_log_level($args->getLevel()),
        $args->getBubble(),
        $args->getRCapSize()
    );
    $handler->setFormatter(
        new JsonFormatter(JsonFormatter::BATCH_MODE_JSON, true, true)
    );
    $logger->pushHandler($handler);
    return $logger;
}

function create_new_log_channel(
    string $new_name,
    LoggerInterface $logger
): LoggerInterface {
    if ($logger instanceof Logger) {
        return $logger->withName($new_name);
    }
    throw new KnownLoggerExc(
        'Logger must implement the LoggerInterface!',
        LogLevE::CRITICAL,
        KEAct::TERM
    );
}

function create_log_redis_c(LoggerArgs $args, int $tries): Predis\Client
{
    $redis = new Predis\Client([
        'scheme' => 'tcp',
        'host' => $args->getRHost(),
        'port' => $args->getRPort(),
        'database' => $args->getRDB(),
    ]);
    tryToConnect($redis->connect(...), $tries);
    return $redis;
}
