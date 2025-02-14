<?php

declare(strict_types=1);

namespace straininfo\server\shared\mvvm\view_model\struct\json\v2;

enum StCcE: string
{
    case CC_CON = 'cultureCollection';
    case CC_HOME = 'homepage';
    case CC_URL = 'url';
    case CC_ON = 'online';
    case CC_ID = 'ccID';
    case CC_NAME = 'name';
    case CC_CC_CODE = 'countryCode';
    case CC_ROR = 'ror';
    case CC_ACT = 'active';
    case CC_DEPR = 'deprecated';
    case CC_GBIF = 'gbif';
    case CC_CODE = 'code';
}
