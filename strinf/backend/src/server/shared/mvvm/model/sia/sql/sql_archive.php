<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\sql;

use straininfo\server\shared\mvvm\model\sia\fields\DBStructArcE;

function get_arc_si_id(int $cnt): string
{
    $param = create_sql_in_templ($cnt, ['strain_archive.doi'], '');
    $std = DBStructArcE::DOI->value;
    $arc = DBStructArcE::ARC->value;
    return <<<EOF
    SELECT DISTINCT 
        strain_archive.doi as {$std},
        strain_archive.archive as {$arc}
    FROM strain_archive
    WHERE {$param};
    EOF;
}
