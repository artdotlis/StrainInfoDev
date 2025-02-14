<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v1;

enum StTaxE: string
{
    case TAX_CON = 'taxon';
    case NAME = 'name';
    case NCBI = 'ncbi';
    case LPSN = 'lpsn';
}
