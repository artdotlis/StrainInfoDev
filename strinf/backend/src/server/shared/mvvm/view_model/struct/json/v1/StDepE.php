<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v1;

enum StDepE: string
{
    case DEP_CON = 'deposition';
    case DEP_ENT_CON = 'depositor';
    case O_CUL = 'origin';
    case O_DES = 'designation';
    case YEAR = 'year';
    case D_NAME = 'name';
    case D_INST = 'institute';
    case D_CC = 'country_code';
    case D_PLA = 'place';
    case D_ROR = 'ror';
    case D_ORCID = 'orcid';
    case D_CONTR = 'contributor';
}
