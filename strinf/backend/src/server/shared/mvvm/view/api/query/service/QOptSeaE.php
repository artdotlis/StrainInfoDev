<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\service;

enum QOptSeaE: string
{
    case IND_ENT = '/service/search/index/{sea_key:.*}';
    case IND_ENT_P = 'sea_key';
    case SEA_ENT = '/service/search/strain/si_id/{si_id:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
    case SEA_ENT_P = 'si_id';
    case SEA_ALL_ENT = '/service/search/strain/all/{ind:[0-9]+}';
    case SEA_ALL_ENT_P = 'ind';
}
