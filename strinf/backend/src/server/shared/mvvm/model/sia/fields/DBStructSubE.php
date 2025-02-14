<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\model\sia\fields;

enum DBStructSubE: string
{
    case NAME = 'submitter_name';
    case INST = 'submitter_institute';
    case RCC = 'submitter_country_code';
    case PLA = 'submitter_place';
    case ROR = 'submitter_ror';
    case ORCID = 'submitter_orcid';
    case TYPE = 'submitter';
}
