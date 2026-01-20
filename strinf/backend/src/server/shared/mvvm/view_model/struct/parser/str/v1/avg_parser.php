<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\parser\str\v1;

use straininfo\server\shared\mvvm\model\struct\DataCon;

use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v1\create_rel_str_con;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v1\get_avg_rel_des;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v1\get_max_arr_arc;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v1\get_max_arr_seq;

/**
 * @template TV
 *
 * @param array<string, TV> $val
 *
 * @return array<string, array<string, array<string, array<string>>>>
 */
function get_avg_rel_des_str(array $val): array
{
    return get_avg_rel_des(
        $val,
        DataCon::R_DES_S->value,
        create_rel_str_con(...)
    );
}

/**
 * @template TV
 *
 * @param array<string, TV> $val
 *
 * @return array<string, array<string, mixed>|scalar|null>
 */
function get_avg_arr_arc(array $val): array
{
    return get_max_arr_arc($val);
}

/**
 * @template TV
 *
 * @param array<string, TV> $val
 *
 * @return array<string, array<string, mixed>|scalar|null>
 */
function get_avg_arr_seq(array $val): array
{
    return get_max_arr_seq($val);
}
