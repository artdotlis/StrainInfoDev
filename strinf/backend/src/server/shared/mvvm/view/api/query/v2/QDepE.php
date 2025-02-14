<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v2;

enum QDepE: string
{
    case ID_P = 'si_dp';
    case AVG = '/v2/data/deposit/avg/{si_dp}';
    case MAX = '/v2/data/deposit/max/{si_dp}';
    case MIN = '/v2/data/deposit/min/{si_dp}';
}
