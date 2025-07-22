import onPrError from '@strinf/ts/functions/err/async';
import type { ApiChanInt } from '@strinf/ts/interfaces/api/mapped';
import type DisChartT from '@strinf/ts/interfaces/chan/model';
import type { DiaCon, DiaF } from '@strinf/ts/interfaces/dom/dia';

class DisCon {
    private readonly apiCall: ApiChanInt;

    private readonly disCharts: DisChartT[];

    private readySt: boolean;

    constructor(apiCall: ApiChanInt, chaT: DisChartT[]) {
        this.apiCall = apiCall;
        this.disCharts = chaT;
        this.readySt = true;
    }

    public get ready(): boolean {
        return this.readySt;
    }

    private getRes(res: DiaCon[], dis: DiaF): void {
        let confs: DiaCon = {};
        for (const val of res) {
            confs = {
                ...confs,
                ...val,
            };
        }
        this.readySt = true;
        dis(confs);
    }

    public initDis(dis: DiaF): void {
        this.readySt = false;
        const con: Promise<DiaCon>[] = [];
        for (const chart of this.disCharts) {
            con.push(chart.config(this.apiCall.createApiCall(chart.api)));
        }
        Promise.all(con)
            .then((res) => {
                this.getRes(res, dis);
            })
            .catch((err: unknown) => {
                this.readySt = true;
                onPrError(err);
            });
    }
}

export default DisCon;
