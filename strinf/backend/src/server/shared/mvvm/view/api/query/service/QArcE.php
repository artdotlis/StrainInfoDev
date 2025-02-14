<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\service;

enum QArcE: string
{
    case ID_P = 'si_id';
    case ARC = '/service/archive/strain/si_id/{si_id}';
}
