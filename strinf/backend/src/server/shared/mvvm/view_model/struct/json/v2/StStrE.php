<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StStrE: string
{
    // con
    case CON = 'strain';
    case MERGE_CON = 'merged';
    case ALT_CON = 'alternative';
    case SAM_CON = 'sample';
    case DEP = 'deposits';
    case STA = 'status';
    // info
    case SI_ID = 'siID';
    case STR_DOI = 'doi';
    case STR_DOI_ON = 'doi_online';
    // pass
    case TYP_STR = 'typeStrain';
    case BAC_DIVE = 'bdID';
    case SAM_SRC = 'source';
    case SAM_CC = 'countryCode';
}
