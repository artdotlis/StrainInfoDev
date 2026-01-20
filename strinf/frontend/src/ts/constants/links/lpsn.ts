// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import { createUrlStr } from '@strinf/ts/functions/http/http';

const LPSN_L = {
    domain: 'lpsn.dsmz.de',
    protocol: 'https',
    port: 443,
} as const;

function lpsn_taxon_id(taxon_id: number | string): string {
    return createUrlStr(LPSN_L, `taxon/${taxon_id}`);
}
export default LPSN_L;
export { lpsn_taxon_id };
