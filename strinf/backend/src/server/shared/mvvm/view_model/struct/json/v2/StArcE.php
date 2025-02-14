<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StArcE: string
{
    case ARC_CON = 'archive';
    case DOI = 'doi';
    case DATE = 'date';
    case TIT = 'title';
}
