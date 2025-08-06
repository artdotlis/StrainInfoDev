<?php

declare(strict_types=1);

namespace straininfo\server\shared\text;

use function Safe\parse_url;

use straininfo\server\interfaces\global\Url;

function createURL(Url $url, string $path): string
{
    $main = $url->getProtocol() . '://' . $url->getDomain();
    if (
        ($url->getProtocol() === 'http' && $url->getPort() !== 80)
        || ($url->getProtocol() === 'https' && $url->getPort() !== 443)
    ) {
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

function encodeUrl(string $url): string
{
    $parts = parse_url($url);
    $encodedPath = '';
    if (isset($parts['path'])) {
        $encodedPath = implode(
            '/',
            array_map(rawurlencode(...), explode('/', $parts['path']))
        );
    }
    $encodedQuery = '';
    if (isset($parts['query'])) {
        $encodedQuery = implode(
            '&',
            array_map(urlencode(...), explode('&', $parts['query']))
        );
    }
    $encodedFragment = '';
    if (isset($parts['fragment'])) {
        $encodedFragment = urlencode($parts['fragment']);
    }
    $rebuiltUrl = '';
    if (isset($parts['scheme'])) {
        $rebuiltUrl .= $parts['scheme'] . '://';
    }
    if (isset($parts['user'])) {
        $rebuiltUrl .= $parts['user'];
        if (isset($parts['pass'])) {
            $rebuiltUrl .= ':' . $parts['pass'];
        }
        $rebuiltUrl .= '@';
    }

    if (isset($parts['host'])) {
        $rebuiltUrl .= $parts['host'];
    }

    if (isset($parts['port'])) {
        $rebuiltUrl .= ':' . $parts['port'];
    }

    $rebuiltUrl .= $encodedPath;

    if ($encodedQuery !== '') {
        $rebuiltUrl .= '?' . $encodedQuery;
    }

    if ($encodedFragment !== '') {
        $rebuiltUrl .= '#' . $encodedFragment;
    }

    return $rebuiltUrl;
}
