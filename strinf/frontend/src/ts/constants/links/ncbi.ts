// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import { createUrlStr } from '@strinf/ts/functions/http/http';

const NCBI_L = {
    domain: 'www.ncbi.nlm.nih.gov',
    protocol: 'https',
    port: 443,
} as const;

function ncbi_taxon_id(id: string | number): string {
    return createUrlStr(NCBI_L, `Taxonomy/Browser/wwwtax.cgi?mode=Info&id=${id}`);
}

function ncbi_genome(acc: string): string {
    return createUrlStr(NCBI_L, `datasets/genome/${acc}`);
}

function ncbi_nucleotide(acc: string): string {
    return createUrlStr(NCBI_L, `nuccore/${acc}`);
}
export default NCBI_L;
export { ncbi_genome, ncbi_nucleotide, ncbi_taxon_id };
