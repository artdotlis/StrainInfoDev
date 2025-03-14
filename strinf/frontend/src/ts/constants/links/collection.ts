import { createUrlStr } from '@strinf/ts/functions/http/http';
import LPSN_L from '@strinf/ts/constants/links/lpsn';
import NCBI_L from '@strinf/ts/constants/links/ncbi';
import BD_L from '@strinf/ts/constants/links/bacdive';
import DSMZ_L from '@strinf/ts/constants/links/dsmz';

const DSMZ = createUrlStr(DSMZ_L, '');
const N4M = 'https://nfdi4microbiota.de';
const DFG = 'https://www.dfg.de/';
const GEO_NAME = 'https://www.geonames.org/';

// collections
const CIP =
    'https://www.pasteur.fr/en/public-health/biobanks-and-collections/collection-institut-pasteur-cip';

const BCCM_LMG = 'https://bccm.belspo.be/about-us/bccm-lmg';
const BCCM = 'https://bccm.belspo.be/';

const CCUG = 'https://www.ccug.se/';

const CIRM = 'https://eng-reseau-cirm.hub.inrae.fr/brc-collection-and-catalogue';

const ICMP =
    'https://www.landcareresearch.co.nz/tools-and-resources/collections/icmp-culture-collection/';

const RCC = 'https://www.roscoff-culture-collection.org/';

// services
const LPSN = createUrlStr(LPSN_L, '');
const NCBI = createUrlStr(NCBI_L, '');
const GBIF = 'https://www.gbif.org/';
const DataCite = 'https://datacite.org/';
const Crossref = 'https://www.crossref.org/';
const ROR = 'https://ror.org/';
const ORCID = 'https://orcid.org/';
const BacDive = createUrlStr(BD_L, '');

// schema
const SCH_ORG = 'https://schema.org/';

// property ids
const DOI_P = 'https://www.wikidata.org/wiki/Property:P356';
const LPSN_P = 'https://www.wikidata.org/wiki/Property:P1991';
const NCBI_P = 'https://www.wikidata.org/wiki/Property:P685';

// social media
const D3_BSKY = 'https://bsky.app/profile/dsmzd3.bsky.social';
const D3_LN = 'https://www.linkedin.com/company/dsmzd3';

export {
    D3_BSKY,
    D3_LN,
    DFG,
    SCH_ORG,
    NCBI_P,
    LPSN_P,
    DOI_P,
    BacDive,
    BCCM_LMG,
    BCCM,
    DSMZ,
    CIP,
    CCUG,
    CIRM,
    ICMP,
    N4M,
    LPSN,
    NCBI,
    GBIF,
    DataCite,
    Crossref,
    ROR,
    ORCID,
    RCC,
    GEO_NAME,
};
