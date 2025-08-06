<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\parser\str\v2;

use straininfo\server\shared\mvvm\view_model\struct\json\v2\StStrE;
use straininfo\server\shared\mvvm\view_model\struct\json\v2\StRegE;
use straininfo\server\shared\mvvm\model\struct\DataCon;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructSubE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructCulE;

use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v2\get_min_arr_tax_base;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v2\get_min_arr_cul_base;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v2\get_min_arr_brc_plain;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v2\get_max_arr_pub as get_max_arr_pub_cul;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v2\create_reg;
use function straininfo\server\shared\arr\check_kt_int;
use function straininfo\server\shared\arr\check_kt_f_str;

/**
 * @template TV
 *
 * @param array<string, TV> $val
 *
 * @return array<string, array<string, mixed>|scalar|null>
 */
function get_max_arr_pub(array $val): array
{
    return get_max_arr_pub_cul($val);
}

/**
 * @template TV
 *
 * @param array<string, TV> $val
 *
 * @return array<int, array<string, mixed>>
 */
function get_max_arr_cul_ent(array $val): array
{
    $submitter = [];
    $key = DataCon::ENT_CON->value;
    if (array_key_exists($key, $val) && is_array($arr = $val[$key])) {
        foreach ($arr as $cul) {
            if (!is_array($cul)) {
                continue;
            }
            $cul_id = check_kt_int($cul, DBStructCulE::CULTURE_ID->value) ?: -1; // @phpstan-ignore argument.type
            if (count($sub_buf = create_reg($cul, DBStructSubE::class)) > 0) { // @phpstan-ignore argument.type
                $submitter[$cul_id] = $sub_buf;
            }
        }
    }
    return $submitter;
}

/**
 * @template TV
 *
 * @param array<string, TV> $val
 *
 * @return array<string, array<int<0, max>, array<string, mixed>>|scalar|null>
 */
function get_max_arr_cul(array $val): array
{
    $cultures = [];
    $key = DataCon::CUL_CON->value;
    if (array_key_exists($key, $val) && is_array($arr = $val[$key])) {
        $submitter = get_max_arr_cul_ent($val);
        foreach ($arr as $cul) {
            if (!is_array($cul)) {
                continue;
            }
            $cul_parsed = get_min_arr_cul_base($cul); // @phpstan-ignore argument.type
            $tax_parsed = get_min_arr_tax_base($cul); // @phpstan-ignore argument.type
            $brc_parsed = get_min_arr_brc_plain($cul); // @phpstan-ignore argument.type
            $cul_id = check_kt_int($cul, DBStructCulE::CULTURE_ID->value) ?: -1; // @phpstan-ignore argument.type
            $sub = $cul_id > 0 && array_key_exists($cul_id, $submitter) ?
                    $submitter[$cul_id] : [];
            $cultures[] = [
                ...$cul_parsed,
                ...$tax_parsed,
                ...$brc_parsed,
                StRegE::REG_CON->value => [
                    StRegE::DATE->value => check_kt_f_str(
                        $cul, // @phpstan-ignore argument.type
                        DBStructCulE::REG_DATE->value
                    ),
                    StRegE::SUB_ENT_CON->value => array_pop($sub),
                ],
            ];
        }
    }
    return [
        StStrE::DEP->value => $cultures,
    ];
}
