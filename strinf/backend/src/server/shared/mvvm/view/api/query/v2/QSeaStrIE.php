<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v2;

enum QSeaStrIE: string
{
    case SEQ_ACC = '/v2/search/strain/seq_acc/{seq_acc:.*}';
    case SEQ_ACC_F = '/v2/search/strain/seq_acc/';
    case SEQ_ACC_P = 'seq_acc';
    case TAX_NAME = '/v2/search/strain/tax_name/{tax_name:.*}';
    case TAX_NAME_F = '/v2/search/strain/tax_name/';
    case TAX_NAME_P = 'tax_name';
    case DES = '/v2/search/strain/des/{des:.*}';
    case DES_F = '/v2/search/strain/des/';
    case DES_P = 'des';
    case CC_NO = '/v2/search/strain/cc_no/{cc_no:.*}';
    case CC_NO_F = '/v2/search/strain/cc_no/';
    case CC_NO_P = 'cc_no';
    case CC = '/v2/search/strain/cc/{cc:.*}';
    case CC_F = '/v2/search/strain/cc/';
    case CC_P = 'cc';
    case SI_DP = '/v2/search/strain/si_dp/{si_dp:.*}';
    case SI_DP_P = 'si_dp';
}
