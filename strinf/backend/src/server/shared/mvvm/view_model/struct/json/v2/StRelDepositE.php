<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StRelDepositE: string
{
    case REL_CON = 'relation';
    case REL_DEP_CON = 'deposit';
    case SI_DP = 'siDP';
    case ORI_SI_DP = 'origin';
    case DES = 'designation';
    case CC_ID = 'ccID';
}
