<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\redis;

enum RedisStE: string
{
    case P_CUL = 'cul_';
    case P_ARC = 'arc_';
    case P_STR = 'str_';

    case SEQ = 'seq';
    case STR = 'str';
    case CUL = 'cul';
    case STR_NO = 'str_no';
    case STR_DES = 'str_des';
    case TAX_NAM = 'tax_name';
    case BRC = 'brc';

    case ALL_CUL = 'all_cul';
    case ALL_STR = 'all_str';
    case ALL_TYP_STR = 'all_str_type';
    case ALL_TYP_CUL = 'all_cul_type';

    case DIS_CPS_CNT = 'dis_dps_cnt';

    case STR_CNT = 'cnt_str';
    case STR_TYP_CNT = 'cnt_str_type';
    case CUL_TYP_CNT = 'cnt_cul_type';
    case CUL_CNT = 'cnt_cul';
    case SPE_CNT = 'cnt_spe';
    case DES_CNT = 'cnt_des';
    case ARC_CNT = 'cnt_arc';
}
