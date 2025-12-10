<?php

declare(strict_types=1);

namespace straininfo\server\shared\text;

use straininfo\server\interfaces\global\Url;

use function Safe\parse_url;

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
        $parsedUrl = parse_url($url);
        if (isset($parsedUrl['host']) && $parsedUrl['host'] !== '') {
            $validDomains[] = $parsedUrl['host'];
        }
    }

    return $validDomains;
}
