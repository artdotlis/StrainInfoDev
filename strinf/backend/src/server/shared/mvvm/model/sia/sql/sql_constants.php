<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\sql;

function get_cul_not_err(): string
{
    return 'culture.status NOT IN (' . implode(',', ['"erroneous data"']) . ')';
}

function get_col_not_err(): string
{
    return <<<EOF
    (
        culture_collection.deprecated IS NULL 
        or culture_collection.deprecated = 0
    )
    EOF;
}
