<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v2;

enum QSeaDepIE: string
{
    case SEQ_ACC = '/v2/search/deposit/seq_acc/{seq_acc:.*}';
    case SEQ_ACC_P = 'seq_acc';
    case SI_ID = '/v2/search/deposit/si_id/{si_id:[0-9]+(?:,[0-9]+)*}';
    case SI_ID_P = 'si_id';
    case TAX_NAME = '/v2/search/deposit/tax_name/{tax_name:.*}';
    case TAX_NAME_P = 'tax_name';
    case DES = '/v2/search/deposit/des/{des:.*}';
    case DES_P = 'des';
    case CC_NO = '/v2/search/deposit/cc_no/{cc_no:.*}';
    case CC_NO_P = 'cc_no';
    case CC = '/v2/search/deposit/cc/{cc:.*}';
    case CC_P = 'cc';
}
