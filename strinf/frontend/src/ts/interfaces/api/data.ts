interface EntityCon {
    name?: string;
    institute?: string;
    countryCode?: string;
    place?: string[];
    ror?: string;
    orcid?: string;
}

interface RegConMin {
    date: string;
    submitter?: EntityCon;
}

interface RegConMax extends RegConMin {
    supervisor?: EntityCon;
}

interface ArcCon {
    doi: string;
    date: string;
    title: string;
}

interface TaxonCon {
    name: string;
    ncbi?: number;
    lpsn?: number;
}

interface DepositMin {
    siDP: number;
    designation: string;
    catalogue?: UrlCon;
    status: string;
    typeStrain: boolean;
    dataSource: string[];
    lastUpdate: string;
    registration?: RegConMin;
    taxon?: TaxonCon;
    cultureCollection?: CCConMin;
}

interface DepositAvg extends DepositMin {
    relation?: string[];
    history?: HistCon[];
    bdID?: number[];
    registration?: RegConMax;
    cultureCollection?: CCCon;
    deposition?: DepCon;
    isolation?: IsoCon;
}

interface RelConMin {
    deposit: RelCulCon[];
}

interface RelCon extends RelConMin {
    designation?: string[];
}

interface DepositStrMin {
    siID: number;
    doi: string;
    merged?: number[];
}

interface StrainStrMin {
    siID: number;
    doi: string;
    merged?: number[];
    typeStrain: boolean;
    status: string;
    relation: RelConMin;
    bdID?: number;
    taxon?: TaxonCon;
    sample?: SamSlimCon;
}

interface StrainStrAvg extends StrainStrMin {
    alternative?: number[];
    sequence?: SeqCon[];
    literature?: PubCon[];
    archive: ArcCon[];
    relation: RelCon;
}

interface DepositIdCon {
    siDP: number;
    designation: string;
}

interface RelCulCon extends DepositIdCon {
    erroneous: boolean;
    origin?: number;
    ccID?: number;
}

interface DepCon {
    designation?: string;
    origin?: number;
    year?: number;
    depositor?: EntityCon[];
}

interface SamSlimCon {
    source: string;
    countryCode?: string;
}

interface SamCon extends SamSlimCon {
    date?: string;
    place?: string[];
}

interface IsoCon {
    sample?: SamCon;
    isolator?: EntityCon[];
}

interface PubCon {
    title: string;
    year: number;
    author?: string;
    publisher?: string;
    pubmed?: number;
    pmc?: number;
    issn?: string;
    doi?: string;
    deposit: DepositIdCon[];
}

interface SeqCon {
    accessionNumber: string;
    type: string;
    deposit: DepositIdCon[];
    length?: number;
    assemblyLevel?: string;
    year?: number;
    description?: string;
}

interface HistCon {
    encoded: string;
    dataSource: string;
}

interface UrlCon {
    url: string;
    online: boolean;
}

interface CCConMin {
    id: number;
    name: string;
    code: string;
    deprecated: boolean;
}

interface CCCon extends CCConMin {
    countryCode: string;
    ror?: string;
    gbif?: string;
    homepage?: UrlCon;
    active: boolean;
}

interface SeaIndCon {
    fullKey: string;
    path: string;
    siID: number;
    strainCount: number;
}

export type {
    SeaIndCon,
    StrainStrAvg,
    DepositMin,
    DepositAvg,
    DepositStrMin,
    StrainStrMin,
};
