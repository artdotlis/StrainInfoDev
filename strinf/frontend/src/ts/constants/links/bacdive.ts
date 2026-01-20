// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import { createUrlStr } from '@strinf/ts/functions/http/http';

const BD_L = {
    domain: 'bacdive.dsmz.de',
    protocol: 'https',
    port: 443,
} as const;

function bac_dive_id(id: string | number): string {
    return createUrlStr(BD_L, `strain/${id}`);
}

export default BD_L;
export { bac_dive_id };
