import type { ServerStatusJT } from '@strinf/ts/interfaces/api/data';
import type ViewChanInt from '@strinf/ts/interfaces/chan/pass';
import Known500Error from '@strinf/ts/errors/known/500';
import getServerStatus from '@strinf/ts/functions/api/status';
import onPrError from '@strinf/ts/functions/err/async';
import ApiChan from '@strinf/ts/mvc/ctrl/chan/ApiChan';
import Controller from '@strinf/ts/mvc/ctrl/Controller';
import PassCon from '@strinf/ts/mvc/model/pass/PassCon';

class PassCtrl extends Controller<ViewChanInt, [number]> {
    private readonly passCon: PassCon;

    private readonly apiChan: ApiChan;

    constructor(version: string) {
        super(version);
        this.apiChan = new ApiChan();
        this.passCon = new PassCon(this.apiChan);
    }

    public override init(cha: ViewChanInt, strainId: number): void {
        const errC = new Known500Error('Internal server error!');
        const dataReq = (status: ServerStatusJT): void => {
            this.reloadWindowOrCb(status.version, () => {
                this.passCon.initPass(cha, strainId);
            });
        };
        getServerStatus(dataReq, () => {
            onPrError(errC);
        });
    }
}

export default PassCtrl;
