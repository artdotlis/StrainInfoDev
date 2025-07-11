<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\struct;

enum StrainStatus: string
{
    case ERR = 'erroneous';
    case PUB_ON = 'published online';
    case PUB_OFF = 'published offline';
    case UND_DEP = 'deposition';
}
