<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\struct;

enum DataCon: string
{
    case REG = 'registration';
    case DEP = 'deposition';
    case ISO = 'isolation';
    case MER = 'merged';
    case ALT = 'alternative';
    case LIT = 'literature';
    case SEQ = 'sequence';
    case R_CUL = 'related_culture';
    case R_DES_S = 'related_designation_strain';
    case R_DES_C = 'related_designation_culture';
    case CUL_CON = 'strain_culture_container';
    case ENT_CON = 'strain_entity_container';
    case ARC = 'archive';
}
