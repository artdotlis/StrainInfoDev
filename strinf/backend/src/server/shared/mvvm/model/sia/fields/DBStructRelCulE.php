<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructRelCulE: string
{
    case STR_NO = 'strain_number';
    case CUL_ID = 'culture_id';
    case ORI_ID = 'origin_id';
    case CC_ID = 'culture_collection_id';
    case CC_ERR = 'culture_erroneous';
}
