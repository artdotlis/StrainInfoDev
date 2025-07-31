<?php

declare(strict_types=1);

namespace straininfo\server;

require_once dirname(__FILE__, 2) . '/vendor/autoload.php';

use function straininfo\server\shared\state\reboot;
use Spiral\RoadRunner;

use Nyholm\Psr7\Factory\Psr17Factory;

$boot = Bootstrap::getBootstrap();
$boot->init(false);

$psr17Factory = new Psr17Factory();
$worker = RoadRunner\Worker::create();
$psr7 = new RoadRunner\Http\PSR7Worker(
    $worker,
    $psr17Factory,
    $psr17Factory,
    $psr17Factory
);

while ($request = $psr7->waitRequest()) {
    try {
        $response = $boot->getApp()->handle($request);
        $psr7->respond($response);
        if($response->getStatusCode() >= 500) {
            $boot = reboot($boot);
        }
    } catch (\Throwable $e) {
        $psr7->respond(
            $psr17Factory->createResponse(500)->withBody(
                $psr17Factory->createStream('Internal server error!')
            )
        );
        $boot = reboot($boot);
    }
}
