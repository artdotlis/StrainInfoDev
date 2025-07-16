import {
    AssemblyLvl,
    DataSource,
    DepositStatus,
    SeqType,
    StrainStatus,
} from '@strinf/ts/constants/api/data';
import { z } from 'zod';

// --- parts

const EntityCon = z.strictObject({
    name: z.string().min(1).optional(),
    institute: z.string().min(1).optional(),
    countryCode: z.string().length(2).optional(),
    place: z.array(z.string().min(1)).optional(),
    ror: z.string().min(1).optional(),
    orcid: z.string().min(1).optional(),
});

const RegConMin = z.strictObject({
    date: z.coerce.date(),
    submitter: EntityCon.optional(),
});

const RegConMax = RegConMin.extend({
    supervisor: EntityCon.optional(),
});

const DepCon = z.strictObject({
    designation: z.string().min(1).optional(),
    origin: z.number().min(1).optional(),
    year: z.number().min(1700).optional(),
    depositor: z.array(EntityCon).optional(),
});

const SamSlimCon = z.strictObject({
    source: z.string().min(1).optional(),
    countryCode: z.string().length(2).optional(),
});

const SamCon = SamSlimCon.extend({
    date: z.coerce.date().optional(),
    place: z.array(z.string().min(1)).optional(),
});

const IsoCon = z.strictObject({
    sample: SamCon.optional(),
    isolator: z.array(EntityCon).optional(),
});

const ArcCon = z.strictObject({
    doi: z.string().min(1),
    date: z.coerce.date(),
    title: z.string().min(1),
});

const TaxonCon = z.strictObject({
    name: z.string().min(1),
    ncbi: z.number().min(1).optional(),
    lpsn: z.number().min(1).optional(),
});

const UrlCon = z.strictObject({
    url: z.url(),
    online: z.boolean(),
});

const HistCon = z.strictObject({
    dataSource: z.enum(DataSource),
    encoded: z.string().min(1),
});

const CCConMin = z.strictObject({
    ccID: z.number().min(1),
    name: z.string().min(1),
    code: z.string().min(1),
    deprecated: z.boolean(),
});

const CCCon = CCConMin.extend({
    countryCode: z.string().length(2),
    ror: z.string().min(1).optional(),
    gbif: z.string().min(1).optional(),
    homepage: UrlCon.optional(),
    active: z.boolean(),
});

const DepositIdCon = z.strictObject({
    siDP: z.number().min(1),
    designation: z.string().min(1),
});

const RelCulCon = DepositIdCon.extend({
    erroneous: z.boolean(),
    origin: z.number().min(1).optional(),
    ccID: z.number().min(1).optional(),
});

const RelConMin = z.strictObject({
    deposit: z.array(RelCulCon).min(1),
});

const RelCon = RelConMin.extend({
    designation: z.array(z.string().min(1)).min(1).optional(),
});

const SeqCon = z.strictObject({
    accessionNumber: z.string().min(1),
    type: z.enum(SeqType),
    deposit: z.array(DepositIdCon).min(1),
    length: z.number().min(1).optional(),
    assemblyLevel: z.enum(AssemblyLvl).optional(),
    year: z.number().min(1700).optional(),
    description: z.string().min(1).optional(),
});

const PubCon = z.strictObject({
    title: z.string().min(1),
    year: z.number().min(1700),
    author: z.string().min(1).optional(),
    publisher: z.string().min(1).optional(),
    pubmed: z.number().min(1).optional(),
    pmc: z.number().min(1).optional(),
    issn: z.string().min(1).optional(),
    doi: z.string().min(1).optional(),
    deposit: z.array(DepositIdCon).min(1),
});

// --- main container

const DepositMin = z.strictObject({
    siDP: z.number().min(1),
    designation: z.string().min(1),
    cultureCollection: CCConMin.optional(),
    catalogue: UrlCon.optional(),
    status: z.enum(DepositStatus),
    typeStrain: z.boolean(),
    lastUpdate: z.coerce.date(),
    dataSource: z.array(z.enum(DataSource)).min(1),
    registration: RegConMin.optional(),
    taxon: TaxonCon.optional(),
});

const DepositAvg = DepositMin.extend({
    relation: z.array(z.string().min(1)).min(1).optional(),
    history: z.array(HistCon).optional(),
    bdID: z.array(z.number().min(1)).min(1).optional(),
    registration: RegConMax.optional(),
    cultureCollection: CCCon.optional(),
    deposition: DepCon.optional(),
    isolation: IsoCon.optional(),
});

const DepositStrainMin = z.strictObject({
    siID: z.number().min(1),
    doi: z.string().min(1),
    merged: z.array(z.number().min(1)).min(1).optional(),
    typeStrain: z.boolean(),
});

const StrainMin = z.strictObject({
    siID: z.number().min(1),
    doi: z.string().min(1),
    merged: z.array(z.number().min(1)).min(1).optional(),
    typeStrain: z.boolean(),
    status: z.enum(StrainStatus),
    relation: RelConMin,
    taxon: TaxonCon.optional(),
    sample: SamSlimCon.optional(),
    bdID: z.number().min(1).optional(),
});

const StrainAvg = StrainMin.extend({
    alternative: z.array(z.number().min(1)).min(1).optional(),
    sequence: z.array(SeqCon).min(1).optional(),
    literature: z.array(PubCon).min(1).optional(),
    archive: z.array(ArcCon).min(1),
    relation: RelCon,
});

const SeaIndCon = z.strictObject({
    fullKey: z.string().min(1),
    path: z.string().min(1),
    siID: z.number().min(1),
    strainCount: z.number().min(1),
});

const SerSeaEle = z.tuple([
    z.number().min(1),
    z.array(z.string().min(1)).min(1),
    z.string(),
    z.union([z.literal(0), z.literal(1)]),
    z.union([z.literal(''), z.string().length(2)]),
    z.union([z.literal(0), z.literal(1), z.literal(2), z.literal(3)]),
]);

// ---- mapped

const SeaIndJ = z.strictObject({
    exact: z.array(SeaIndCon),
    match: z.array(SeaIndCon),
});
const SerSeaAllJ = z.strictObject({
    count: z.number().min(1),
    data: z.array(SerSeaEle).min(1),
    next: z.number().min(1).optional(),
});

const PassJ = z.object({
    strain: StrainAvg,
});

const DetailsJ = z.strictObject({
    deposit: DepositAvg,
    strain: DepositStrainMin,
});

const InfoDJ = z.object({
    deposit: DepositMin,
});

const InfoSJ = z.object({
    strain: StrainMin,
});

const MaintenanceInt = z.strictObject({
    status: z.boolean(),
    duration: z.string(),
    zone: z.string(),
});

const ServerStatusJ = z.strictObject({
    private: z.boolean(),
    version: z.string().min(7),
    maintenance: MaintenanceInt,
});

type ServerStatusJT = z.infer<typeof ServerStatusJ>;
type DetailsJT = z.infer<typeof DetailsJ>;
type PassJT = z.infer<typeof PassJ>;
type SerSeaAllJT = z.infer<typeof SerSeaAllJ>;
type SerSeaEleT = z.infer<typeof SerSeaEle>;
type SeaIndJT = z.infer<typeof SeaIndJ>;
type SeaIndConT = z.infer<typeof SeaIndCon>;
export type {
    ServerStatusJT,
    DetailsJT,
    PassJT,
    SerSeaAllJT,
    SeaIndJT,
    SeaIndConT,
    SerSeaEleT,
};

export { ServerStatusJ, InfoSJ, InfoDJ, DetailsJ, PassJ, SerSeaAllJ, SeaIndJ, SerSeaEle };
