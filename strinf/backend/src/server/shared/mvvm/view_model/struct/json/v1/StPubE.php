<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v1;

enum StPubE: string
{
    case LIT_CON = 'literature';
    case LIT_CUL_CON = 'culture';
    case PMC = 'pmc';
    case PM = 'pubmed';
    case ISSN = 'issn';
    case DOI = 'doi';
    case TITLE = 'title';
    case AUT = 'author';
    case PUB = 'publisher';
    case YEAR = 'year';
    case CUL_ID = 'id';
    case STR_NO = 'strain_number';
}
