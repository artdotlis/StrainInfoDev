<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructSupE: string
{
    case NAME = 'supervisor_name';
    case INST = 'supervisor_institute';
    case RCC = 'supervisor_country_code';
    case PLA = 'supervisor_place';
    case ROR = 'supervisor_ror';
    case ORCID = 'supervisor_orcid';
    case TYPE = 'supervisor';
}
