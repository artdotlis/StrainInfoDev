import QApiCon from '@strinf/ts/constants/api/q_api';
import Known500Error from '@strinf/ts/errors/known/500';
import { toArrIndSeaIndRes } from '@strinf/ts/functions/api/map';
import onPrError from '@strinf/ts/functions/err/async';
import { checkRespTyp, fetchRetry } from '@strinf/ts/functions/http/http';
import type { ApiChanInt, SeaIndR } from '@strinf/ts/interfaces/api/mapped';
import type ViewChanInt from '@strinf/ts/interfaces/chan/sea_ind';

class SeaIndexCon {
    private readonly apiCall: ApiChanInt;

    private ready: boolean;

    private lastInput: string;

    constructor(apiCall: ApiChanInt) {
        this.apiCall = apiCall;
        this.ready = true;
        this.lastInput = '';
    }

    private runSeaApi(cha: ViewChanInt, key: string) {
        const api = QApiCon.seaKeyInd;
        const call = this.apiCall.createApiCall(`${api}${key}`);
        const cIn = key;
        setTimeout(
            () =>
                void fetchRetry(call)
                    .then(async (resp) => checkRespTyp<SeaIndR>(resp, toArrIndSeaIndRes))
                    .then((json: SeaIndR): void => {
                        cha.tab(json);
                        const lIn = this.lastInput;
                        this.ready = true;
                        if (cIn !== lIn) {
                            this.initSea(cha, lIn);
                        }
                    })
                    .catch((err: unknown) => {
                        this.ready = true;
                        if (err instanceof Known500Error) {
                            onPrError(err);
                        }
                    }),
            200
        );
    }

    public initSea(cha: ViewChanInt, args: string): void {
        this.lastInput = args;
        if (!args.includes(',') && args !== '' && this.ready) {
            this.ready = false;
            this.runSeaApi(cha, args);
        }
    }
}

export default SeaIndexCon;
