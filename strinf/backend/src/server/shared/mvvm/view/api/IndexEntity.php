<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api;

enum IndexEntity: int
{
    case TAX = 0;
    case SEQ_ACC = 1;
    case DES = 2;
    case CCNO_DES = 3;
    case BRC = 4;
}
