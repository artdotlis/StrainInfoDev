<?php

// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view\api\query\v1;

enum QSeaCulIE: string
{
    case SEQ_ACC = '/v1/search/culture/seq_acc/{seq_acc:.*}';
    case SEQ_ACC_P = 'seq_acc';
    case STR_ID = '/v1/search/culture/str_id/{str_id:[0-9]+(?:,[0-9]+)*}';
    case STR_ID_P = 'str_id';
    case TAX_NAME = '/v1/search/culture/tax_name/{tax_name:.*}';
    case TAX_NAME_P = 'tax_name';
    case STR_DES = '/v1/search/culture/str_des/{str_des:.*}';
    case STR_DES_P = 'str_des';
    case STR_NO = '/v1/search/culture/str_no/{str_no:.*}';
    case STR_NO_P = 'str_no';
    case BRC = '/v1/search/culture/brc/{brc:.*}';
    case BRC_P = 'brc';
}
