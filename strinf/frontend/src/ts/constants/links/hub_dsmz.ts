import { createUrlStr } from '@strinf/ts/functions/http/http';

const HUB_L = {
    domain: 'hub.dsmz.de',
    protocol: 'https',
    port: 443,
} as const;

function hub_dsmz_search(search: string): string {
    return createUrlStr(HUB_L, `#/search/${search}`);
}

export default HUB_L;

export { hub_dsmz_search };
