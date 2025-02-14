<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v2;

enum QCntE: string
{
    case STR_CNT = '/v2/count/strains';
    case ARC_CNT = '/v2/count/archive';
    case DEP_CNT = '/v2/count/deposits';
    case SPE_CNT = '/v2/count/species';
    case DES_CNT = '/v2/count/designations';
    case STR_TYP_CNT = '/v2/count/strains/type';
    case DEP_SR_CNT = '/v2/count/deposits/strainregistry';
}
