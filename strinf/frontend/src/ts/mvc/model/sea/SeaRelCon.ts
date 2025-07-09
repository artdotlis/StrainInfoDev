import QApiCon from '@strinf/ts/constants/api/q_api';
import Known500Error from '@strinf/ts/errors/known/500';
import { toArrSeaRes } from '@strinf/ts/functions/api/map';
import onPrError from '@strinf/ts/functions/err/async';
import { checkRespArr, fetchRetry } from '@strinf/ts/functions/http/http';
import type { ApiChanInt, SeaR } from '@strinf/ts/interfaces/api/mapped';
import type ViewChanInt from '@strinf/ts/interfaces/chan/sea_rel';
import type { RelDataT } from '@strinf/ts/interfaces/dom/sea_rel';

class SeaRelCon {
    private readonly apiCall: ApiChanInt;

    private ready: boolean;

    private lastInput: string;

    private omitStrain: number[];

    constructor(apiCall: ApiChanInt) {
        this.apiCall = apiCall;
        this.ready = true;
        this.lastInput = '';
        this.omitStrain = [];
    }

    private onError(err: unknown): void {
        this.ready = true;
        if (err instanceof Known500Error) {
            onPrError(err);
        }
    }

    private runSeaStrMin(
        cha: ViewChanInt,
        api: string,
        seaReq: string,
        strIds: number[]
    ): void {
        const results: RelDataT = {
            count: strIds.length,
            strains: [],
        };
        const strId = strIds.slice(0, 3);
        const call = this.apiCall.createApiCall(`${QApiCon.strMin}${strId.join(',')}`);
        fetchRetry(call)
            .then(async (resp) => checkRespArr<SeaR>(resp, toArrSeaRes))
            .then((json: SeaR[]): void => {
                for (const jsoE of json) {
                    results.strains.push({
                        id: jsoE[0],
                        cultures: jsoE[1],
                    });
                }
                this.finishCall(cha, api, seaReq, results);
            })
            .catch((err: unknown) => {
                this.onError(err);
            });
    }

    private finishCall(
        cha: ViewChanInt,
        api: string,
        key: string,
        results: RelDataT
    ): void {
        cha.tab(results);
        const lIn = this.lastInput;
        this.ready = true;
        if (key !== lIn) {
            this.initSea(cha, lIn, api, this.omitStrain);
        }
    }

    private runSeaStrIds(
        cha: ViewChanInt,
        api: string,
        key: string,
        omitStr: number[]
    ): void {
        const call = this.apiCall.createApiCall(`${api}${key}`);
        const cIn = key;
        setTimeout(
            () =>
                void fetchRetry(call)
                    .then(async (resp) =>
                        checkRespArr<number>(resp, (num) => Number(num))
                    )
                    .then((json: number[]): void => {
                        const filtered = json.filter((sid) => !omitStr.includes(sid));
                        if (filtered.length === 0) {
                            this.finishCall(cha, api, cIn, { count: 0, strains: [] });
                        } else {
                            this.runSeaStrMin(cha, api, key, filtered);
                        }
                    })
                    .catch((err: unknown) => {
                        this.onError(err);
                    }),
            200
        );
    }

    public initSea(cha: ViewChanInt, args: string, api: string, omitStr: number[]): void {
        this.lastInput = args;
        this.omitStrain = omitStr;
        const cApi = api as unknown as QApiCon;
        if (
            [
                QApiCon.seaStrCCNo,
                QApiCon.seaStrStrDes,
                QApiCon.seaStrTaxName,
                QApiCon.seaStrSeqAcc,
                QApiCon.seaStrCulId,
            ].includes(cApi) &&
            this.ready
        ) {
            this.ready = false;
            this.runSeaStrIds(cha, api, args, omitStr);
        } else {
            this.onError(new Known500Error(`Unknown arguments detected: ${cApi}`));
        }
    }
}

export default SeaRelCon;
