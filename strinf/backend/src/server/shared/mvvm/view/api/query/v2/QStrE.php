<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v2;

enum QStrE: string
{
    case ID_P = 'si_id';
    case AVG = '/v2/data/strain/avg/{si_id}';
    case MAX = '/v2/data/strain/max/{si_id}';
    case MIN = '/v2/data/strain/min/{si_id}';
}
