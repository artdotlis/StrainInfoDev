// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import IdAcrTagCon from '@strinf/ts/constants/acr/id_acr';
import { SEQ_ACC } from '@strinf/ts/constants/regexp/seq';

const SR_CUL_ID = new RegExp(`^${IdAcrTagCon.depId}\\s*(\\d+)$`, 'i');
const SR_STR_ID = new RegExp(`^${IdAcrTagCon.strId}\\s*(\\d+)(\\.\\d+)?$`, 'i');
const SR_DES = /^([^,]{2,}(?:,|$))+/;
const SR_BRC = /^(([A-Z]{2}[^,0-9\s]*)(?:,|$))+/i;
const SR_TAX = /^(([A-Z][a-z]+(\s+[a-z]{2,})*)(\s*,\s*)?)+$/;
const SR_SEQ_ACC = new RegExp(`^((${SEQ_ACC.join('|')})(\\s*,\\s*)?)+$`);

export { SR_BRC, SR_CUL_ID, SR_DES, SR_SEQ_ACC, SR_STR_ID, SR_TAX };
