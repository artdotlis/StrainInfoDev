import QApiCon from '@strinf/ts/constants/api/q_api';
import { getApiToStr } from '@strinf/ts/functions/api/map';
import onPrError from '@strinf/ts/functions/err/async';
import type { ApiChanInt } from '@strinf/ts/interfaces/api/maped';
import type { DataCon } from '@strinf/ts/interfaces/dom/global';
import type { StaF } from '@strinf/ts/interfaces/dom/ind';
import crStat from '@strinf/ts/mvc/model/fun/create_stat';

const THE: [string, string][] = [
    [QApiCon.cntStr, getApiToStr(QApiCon.cntStr)],
    [QApiCon.cntTStr, getApiToStr(QApiCon.cntTStr)],
    [QApiCon.cntArc, getApiToStr(QApiCon.cntArc)],
    [QApiCon.cntCul, getApiToStr(QApiCon.cntCul)],
    [QApiCon.cntTCul, getApiToStr(QApiCon.cntTCul)],
    [QApiCon.cntSpe, getApiToStr(QApiCon.cntSpe)],
    [QApiCon.cntDes, getApiToStr(QApiCon.cntDes)],
];

class StatsConM {
    private state: Promise<DataCon<number>>[];

    private readonly apiCall: ApiChanInt;

    private readySt: boolean;

    constructor(apiCall: ApiChanInt) {
        this.apiCall = apiCall;
        this.state = [];
        this.readySt = true;
    }

    public get ready(): boolean {
        return this.readySt;
    }

    public initStats(sta: StaF): void {
        this.readySt = false;
        this.state = [];
        for (const ele of THE) {
            this.state.push(crStat(this.apiCall.createApiCall(ele[0]), ele[1]));
        }
        Promise.all(this.state)
            .then((res: DataCon<number>[]) => {
                this.readySt = true;
                sta(res);
            })
            .catch((err: unknown) => {
                this.readySt = true;
                onPrError(err);
            });
    }
}

export default StatsConM;
