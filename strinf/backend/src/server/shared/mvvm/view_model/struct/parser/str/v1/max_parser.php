<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\parser\str\v1;

use function straininfo\server\shared\arr\check_kt_f_str;
use function straininfo\server\shared\arr\check_kt_int;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructCulE;
use straininfo\server\shared\mvvm\model\sia\fields\DBStructSubE;
use straininfo\server\shared\mvvm\model\struct\DataCon;

use straininfo\server\shared\mvvm\view_model\struct\json\v1\StRegE;
use straininfo\server\shared\mvvm\view_model\struct\json\v1\StStrE;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v1\create_reg;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v1\get_max_arr_pub as get_max_arr_pub_cul;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v1\get_min_arr_cul_base;
use function straininfo\server\shared\mvvm\view_model\struct\parser\cul\v1\get_min_arr_tax_base;

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
    if (array_key_exists($key, $val) && is_array($val[$key])) {
        foreach ($val[$key] as $cul) {
            if (!is_array($cul)) {
                continue;
            }
            $cul_id = check_kt_int($cul, DBStructCulE::CULTURE_ID->value) ?: -1; // @phpstan-ignore argument.type
            if (!empty($sub_buf = create_reg($cul, DBStructSubE::class))) { // @phpstan-ignore argument.type
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
    if (array_key_exists($key, $val) && is_array($val[$key])) {
        $submitter = get_max_arr_cul_ent($val);
        foreach ($val[$key] as $cul) {
            if (!is_array($cul)) {
                continue;
            }
            $cul_parsed = get_min_arr_cul_base($cul); // @phpstan-ignore argument.type
            $tax_parsed = get_min_arr_tax_base($cul); // @phpstan-ignore argument.type
            $cul_id = check_kt_int($cul, DBStructCulE::CULTURE_ID->value) ?: -1; // @phpstan-ignore argument.type
            $sub = $cul_id > 0 && array_key_exists($cul_id, $submitter) ?
                    $submitter[$cul_id] : [];
            $cultures[] = [
                ...$cul_parsed,
                ...$tax_parsed,
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
        StStrE::CUL->value => $cultures,
    ];
}
