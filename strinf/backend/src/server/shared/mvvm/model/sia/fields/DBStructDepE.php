<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructDepE: string
{
    case DES = 'dep_des';
    case ORI_CUL = 'dep_ori_cul';
    case YEAR = 'dep_year';
    case NAME = 'dep_name';
    case INST = 'dep_institute';
    case DCC = 'dep_country_code';
    case PLA = 'dep_place';
    case ROR = 'dep_ror';
    case ORCID = 'dep_orcid';
    case CONTR = 'dep_contribution';
}
