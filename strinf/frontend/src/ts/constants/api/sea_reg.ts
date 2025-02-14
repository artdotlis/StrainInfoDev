import IdAcrTagCon from '@strinf/ts/constants/acr/id_acr';
import { SEQ_ACC } from '@strinf/ts/constants/regexp/seq';

const SR_CUL_ID = new RegExp(`^${IdAcrTagCon.depId}\\s*(\\d+)$`, 'i');
const SR_STR_ID = new RegExp(`^${IdAcrTagCon.strId}\\s*(\\d+)(\\.\\d+)?$`, 'i');
const SR_DES = /^([^,]{2,}(\s*,\s*)?)+$/;
const SR_BRC = /^(([A-Za-z]{2,}[^,0-9]*)+(\s*,\s*)?)+$/;
const SR_TAX = /^(([A-Za-z]{2,}\s*)+(\s*,\s*)?)+$/;
const SR_SEQ_ACC = new RegExp(`^((${SEQ_ACC.join('|')})(\\s*,\\s*)?)+$`);

export { SR_CUL_ID, SR_STR_ID, SR_DES, SR_BRC, SR_TAX, SR_SEQ_ACC };
