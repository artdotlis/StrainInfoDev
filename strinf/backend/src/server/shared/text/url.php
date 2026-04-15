<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\text;

use straininfo\server\interfaces\global\Url;
use Uri\Rfc3986\Uri;

function create_url(Url $url, string $path): string
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

function create_domain_url(Url $url): string
{
    return create_url($url, '');
}

/**
 * @param array<string> $urls
 *
 * @return array<string>
 */
function extract_valid_domains(array $urls): array
{
    $validDomains = [];
    foreach ($urls as $url) {
        $parsedUrl = new Uri($url);
        $host = $parsedUrl->getHost();
        if ($host!==null && $host !== '') {
            $validDomains[] = $host;
        }
    }

    return $validDomains;
}
