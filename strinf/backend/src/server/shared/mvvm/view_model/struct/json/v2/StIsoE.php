<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StIsoE: string
{
    // con
    case ISO_CON = 'isolation';
    case ISO_ENT_CON = 'isolator';
    // isolator
    case I_NAME = 'name';
    case I_INST = 'institute';
    case I_CC = 'countryCode';
    case I_PLA = 'place';
    case I_ROR = 'ror';
    case I_ORCID = 'orcid';
    case I_CONTR = 'contributor';
}
