<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v1;

enum QStrE: string
{
    case ID_P = 'str_id';
    case AVG = '/v1/data/strain/avg/{str_id}';
    case MAX = '/v1/data/strain/max/{str_id}';
    case MIN = '/v1/data/strain/min/{str_id}';
}
