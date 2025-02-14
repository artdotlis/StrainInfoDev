<?php

declare(strict_types=1);

namespace straininfo\server\exceptions;

use Safe\Exceptions\OutcontrolException;
use Safe\Exceptions\SimplexmlException;
use function Safe\ini_set;

use function Safe\json_encode;
use function Safe\ob_clean;
use function Safe\ob_end_flush;
use function Safe\ob_start;
use function Safe\preg_match;
use function Safe\simplexml_load_string;
use straininfo\server\configs\Config;
use function straininfo\server\shared\mvvm\view\cspHeader;

function print_msg_500(bool $over): void
{
    print_err_msg($over, 'Internal server error!', 500);
}

function print_msg_503(bool $over): void
{
    print_err_msg($over, 'Service unavailable!', 503);
}

function clean_buf(string $message, int $type): void
{
    $toComp = $_SERVER['HTTP_ACCEPT_ENCODING'];
    $msg = $message;
    try {
        ob_clean();
    } catch (OutcontrolException) {
        $msg = $message . "\nFailed to delete buffer!";
    }
    ob_start();
    http_response_code($type);
    if (Config::isProductionBuild()) {
        header('Content-Security-Policy: ' . cspHeader());
    }
    header('Access-Control-Allow-Origin: *');
    header('Cache-Control: "no-store"');
    header('Encoding: UTF-8');
    header('Content-Type: application/json');
    if (is_string($toComp) && preg_match('/(,|\s|^)gzip(,|\s|$)/', $toComp) === 1) {
        header('Content-Encoding: gzip;');
        ini_set('zlib.output_compression_level', '5');
        ob_start(ob_gzhandler(...));
    }
    echo create_error_json($msg, $type);
    ob_end_flush();
}

function print_err_msg(bool $over, string $msg, int $type): void
{
    $buf = ob_get_contents() ?: '';
    try {
        simplexml_load_string($buf);
        if ($over) {
            clean_buf($msg, $type);
        }
    } catch (SimplexmlException) {
        clean_buf($msg, $type);
    }
}

function create_error_json(string $msg, int $type, string $info = ''): string
{
    $results = [
        'message' => $msg,
        'code' => $type,
    ];
    if ($info !== '') {
        $results['info'] = $info;
    }
    return json_encode($results);
}
