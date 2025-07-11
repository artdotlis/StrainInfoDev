<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructStrE: string
{
    // avg
    case STRAIN_ID = 'strain_id';
    case STRAIN_DOI = 'strain_doi';
    case TYP_CUL = 's_type_culture';
    case STR_STA_ON = 's_status_on';
    case STR_STA_ERR = 's_status_err';
    // max
    case TYP_STR = 's_type_strain';
    case BAC_DIVE = 's_bac_dive';
    case SAM_SRC = 's_sam_src';
    case SAM_CC = 's_sam_cc';
    // main
    case MAIN_ID = 'main_strain_id';
    // merge
    case MERGE_ID = 'merge_strain_id';
    // merge
    case ALT_ID = 'alt_strain_id';
}
