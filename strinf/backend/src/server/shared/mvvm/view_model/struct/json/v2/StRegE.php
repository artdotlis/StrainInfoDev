<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StRegE: string
{
    case REG_CON = 'registration';
    case SUB_ENT_CON = 'submitter';
    case SUP_ENT_CON = 'supervisor';
    case DATE = 'date';
    case S_NAME = 'name';
    case S_INST = 'institute';
    case S_CC = 'countryCode';
    case S_PLA = 'place';
    case S_ROR = 'ror';
    case S_ORCID = 'orcid';
}
