import { createUrlStr } from '@strinf/ts/functions/http/http';

const ENA_L = {
    domain: 'www.ebi.ac.uk',
    protocol: 'https',
    port: 443,
} as const;

function ena_genome(acc: string): string {
    return createUrlStr(ENA_L, `ena/browser/view/${acc}`);
}

function ena_nucleotide(acc: string): string {
    return ena_genome(acc);
}

export { ena_genome, ena_nucleotide };
