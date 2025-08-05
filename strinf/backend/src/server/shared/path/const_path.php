<?php

declare(strict_types=1);

namespace straininfo\server\shared\path;

/** @return array<string> */
function get_prefix(): array
{
    return ['..', '..', '..'];
}

function get_config_root(): string
{
    return merge_path(__DIR__, [...get_prefix(), 'configs']);
}

function get_public_root(): string
{
    return merge_path(__DIR__, [...get_prefix(), 'public']);
}


/** @param array<string> $path_el */
function merge_path(string $root, array $path_el): string
{
    return $root . DIRECTORY_SEPARATOR . implode(DIRECTORY_SEPARATOR, $path_el);
}
