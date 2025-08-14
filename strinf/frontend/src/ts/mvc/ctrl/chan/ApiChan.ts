import type { ApiChanInt } from '@strinf/ts/interfaces/api/mapped';
import type { ConfLinkT } from '@strinf/ts/interfaces/misc/configs';
import CONFIG from '@strinf/ts/configs/config';

class ApiChan implements ApiChanInt {
    private readonly apiConf: ConfLinkT;

    constructor() {
        this.apiConf = CONFIG.backend;
    }

    public createApiCall(extra: string): string {
        const extRe = !extra.startsWith('/') ? `/${extra}` : extra;
        const main = `${this.apiConf.protocol}://${this.apiConf.domain}`;
        return `${main}:${this.apiConf.port}${extRe}`;
    }
}

export default ApiChan;
