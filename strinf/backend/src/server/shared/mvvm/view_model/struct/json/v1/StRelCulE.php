<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v1;

enum StRelCulE: string
{
    case REL_CON = 'relation';
    case REL_CUL_CON = 'culture';
    case CUL_ID = 'id';
    case ORI_CUL_ID = 'origin';
    case STR_NO = 'strain_number';
}
