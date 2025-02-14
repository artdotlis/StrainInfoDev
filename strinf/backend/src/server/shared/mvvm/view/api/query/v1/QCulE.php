<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v1;

enum QCulE: string
{
    case ID_P = 'cul_id';
    case AVG = '/v1/data/culture/avg/{cul_id}';
    case MAX = '/v1/data/culture/max/{cul_id}';
    case MIN = '/v1/data/culture/min/{cul_id}';
}
