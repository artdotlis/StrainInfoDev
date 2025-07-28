<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v1;

enum QSeaStrIE: string
{
    case SEQ_ACC = '/v1/search/strain/seq_acc/{seq_acc:.*}';
    case SEQ_ACC_F = '/v1/search/strain/seq_acc/';
    case SEQ_ACC_P = 'seq_acc';
    case TAX_NAME = '/v1/search/strain/tax_name/{tax_name:.*}';
    case TAX_NAME_F = '/v1/search/strain/tax_name/';
    case TAX_NAME_P = 'tax_name';
    case STR_DES = '/v1/search/strain/str_des/{str_des:.*}';
    case STR_DES_F = '/v1/search/strain/str_des/';
    case STR_DES_P = 'str_des';
    case STR_NO = '/v1/search/strain/str_no/{str_no:.*}';
    case STR_NO_F = '/v1/search/strain/str_no/';
    case STR_NO_P = 'str_no';
    case BRC = '/v1/search/strain/brc/{brc:.*}';
    case BRC_F = '/v1/search/strain/brc/';
    case BRC_P = 'brc';
    case CUL_ID = '/v1/search/strain/cul_id/{cul_id:[0-9]+(?:,[0-9]+)*}';
    case CUL_ID_P = 'cul_id';
}
