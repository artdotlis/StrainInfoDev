import Known500Error from '@strinf/ts/errors/known/500';
import getServerStatus from '@strinf/ts/functions/api/status';
import onPrError from '@strinf/ts/functions/err/async';
import emptyCall from '@strinf/ts/functions/misc/call';
import type { ServerStatusInt } from '@strinf/ts/interfaces/api/maped';
import type ViewChanInt from '@strinf/ts/interfaces/chan/sea_rel';
import ApiChan from '@strinf/ts/mvc/ctrl/chan/ApiChan';
import SeaRelCon from '@strinf/ts/mvc/model/sea/SeaRelCon';
import Controller from '@strinf/ts/mvc/ctrl/Controller';

class SeaRelCtrl extends Controller<ViewChanInt, [string, string, number[]]> {
    private readonly idCon: SeaRelCon;

    private readonly apiChan: ApiChan;

    constructor(version: string) {
        super(version);
        this.apiChan = new ApiChan();
        this.idCon = new SeaRelCon(this.apiChan);
    }

    public override init(
        cha: ViewChanInt,
        args: string,
        api: string,
        omitStr: number[]
    ): void {
        const errC = new Known500Error('Internal server error!');
        const dataReq = (status: ServerStatusInt): void => {
            this.reloadWindowOrCb(status.version, () => {
                this.idCon.initSea(cha, args, api, omitStr);
            });
        };
        getServerStatus(
            dataReq,
            () => {
                onPrError(errC);
            },
            emptyCall
        );
    }
}

export default SeaRelCtrl;
