<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\sql\cul;

use straininfo\server\shared\mvvm\model\sia\fields\DBStructSubE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructSupE;

/** @return array<string> */
function get_cul_id_max(): array
{
    return [
        get_sql_cul_avg() . ' WHERE culture.id=?;',
        get_sql_entity(DBStructSubE::class) . ' WHERE culture.id=?;',
        get_sql_depositor() . ' WHERE culture.id=?;',
        get_sql_isolator() . ' WHERE culture.id=?;',
        get_sql_entity(DBStructSupE::class) . ' WHERE culture.id=?;',
        get_sql_cul_rel_des(),
    ];
}
