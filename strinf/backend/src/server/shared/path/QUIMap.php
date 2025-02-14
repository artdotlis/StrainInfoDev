<?php

declare(strict_types=1);

namespace straininfo\server\shared\path;

enum QUIMap: string
{
    case STRAIN = '/strain';
    case SITEMAP = '/sitemap_index.xml';
    case ROBOT = '/robots.txt';
}
