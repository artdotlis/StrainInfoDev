<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StPubE: string
{
    case LIT_CON = 'literature';
    case LIT_DEP_CON = 'deposit';
    case PMC = 'pmc';
    case PM = 'pubmed';
    case ISSN = 'issn';
    case DOI = 'doi';
    case TITLE = 'title';
    case AUT = 'author';
    case PUB = 'publisher';
    case YEAR = 'year';
    case SI_DP = 'siDP';
    case DES = 'designation';
}
