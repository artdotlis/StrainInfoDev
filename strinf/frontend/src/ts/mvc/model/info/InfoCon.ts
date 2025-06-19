import QApiCon from '@strinf/ts/constants/api/q_api';
import Known404Error from '@strinf/ts/errors/known/404';
import Known500Error from '@strinf/ts/errors/known/500';
import { getApiToStr, toArrInfoRes } from '@strinf/ts/functions/api/map';
import onPrError from '@strinf/ts/functions/err/async';
import { checkRespArr, fetchRetry } from '@strinf/ts/functions/http/http';
import type { ApiChanInt, InfoR } from '@strinf/ts/interfaces/api/maped';
import type ViewChanInt from '@strinf/ts/interfaces/chan/info';

class InfoCon {
    private readonly apiCall: ApiChanInt;

    constructor(apiCall: ApiChanInt) {
        this.apiCall = apiCall;
    }

    private static checkInfo(
        cha: ViewChanInt,
        json: InfoR[],
        args: number[],
        api: string
    ): void {
        if (json.length > 0) {
            cha.res(json);
        } else {
            throw new Known404Error(getApiToStr(api), `${args}`);
        }
    }

    private runInfoApi(cha: ViewChanInt, api: string, args: number[]): void {
        const call = this.apiCall.createApiCall(`${api}${args}`);
        fetchRetry(call)
            .then(async (resp) => checkRespArr<InfoR>(resp, toArrInfoRes))
            .then((json: InfoR[]) => {
                InfoCon.checkInfo(cha, json, args, api);
            })
            .catch((err: unknown) => {
                onPrError(err);
            });
    }

    public initInfo(cha: ViewChanInt, args: number[], api: string): void {
        const cApi = api as unknown as QApiCon;
        if (QApiCon.culMin === cApi) {
            this.runInfoApi(cha, api, args);
        } else {
            onPrError(new Known500Error(`Unknown arguments detected: ${cApi}`));
        }
    }
}

export default InfoCon;
