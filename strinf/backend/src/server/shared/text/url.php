<?php

declare(strict_types=1);

namespace straininfo\server\shared\text;

use straininfo\server\interfaces\global\Url;

function createURL(Url $url, string $path): string
{
    $main = $url->getProtocol() . '://' . $url->getDomain();
    if (($url->getProtocol() === 'http' && $url->getPort() !== 80) || ($url->getProtocol() === 'https' && $url->getPort() !== 443)) {
        $main .= ':' . $url->getPort();
    }
    $c_path = $path;
    if ($path !== '' && $path[0] !== '/') {
        $c_path = '/' . $path;
    }
    return $main . $c_path;
}

function createDomain(Url $url): string
{
    return createURL($url, '');
}
