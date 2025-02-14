<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\service;

enum QAllE: string
{
    case STR = '/service/all/strains';
    case STR_TYP = '/service/all/strains/type';
    case CUL = '/service/all/deposits';
    case CUL_TYP = '/service/all/deposits/strainregistry';
}
