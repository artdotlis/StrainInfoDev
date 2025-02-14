<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\parser\ind;

use function straininfo\server\shared\mvvm\view\api\map_ent_to_api;

use function straininfo\server\shared\mvvm\view\api\map_integer_to_ent;
use straininfo\server\shared\mvvm\view_model\struct\json\StIndE;

/**
 * @param array{string,int<0, 4>,int,int} $arr
 *
 * @return array<string, string|int>
 */
function parse_sea_term(array $arr): array
{
    [$f_key, $path, $str_id, $str_cnt] = $arr;
    return [
        StIndE::F_KEY->value => $f_key,
        StIndE::PATH->value => map_ent_to_api(
            map_integer_to_ent($path)
        ),
        StIndE::STR_ID->value => $str_id,
        StIndE::STR_CNT->value => $str_cnt,
    ];
}
