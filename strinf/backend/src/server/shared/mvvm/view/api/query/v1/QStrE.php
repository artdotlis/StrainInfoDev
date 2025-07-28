<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v1;

enum QStrE: string
{
    case ID_P = 'str_id';
    case AVG = '/v1/data/strain/avg/{str_id:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
    case MAX = '/v1/data/strain/max/{str_id:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
    case MIN = '/v1/data/strain/min/{str_id:[0-9]+(?:-[0-9]+)?(?:,[0-9]+(?:-[0-9]+)?)*}';
}
