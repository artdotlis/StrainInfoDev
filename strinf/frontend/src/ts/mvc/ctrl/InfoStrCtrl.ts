import type ViewChanInt from '@strinf/ts/interfaces/chan/info';
import InfoCon from '@strinf/ts/mvc/model/info/InfoCon';
import ApiChan from '@strinf/ts/mvc/ctrl/chan/ApiChan';
import type { InfoS, ServerStatusInt } from '@strinf/ts/interfaces/api/mapped';
import QApiCon from '@strinf/ts/constants/api/q_api';
import Controller from '@strinf/ts/mvc/ctrl/Controller';
import MemoryCtrl from '@strinf/ts/mvc/ctrl/MemoryCtrl';
import { toArrInfoStrRes } from '@strinf/ts/functions/api/map';

class InfoStrCtrl extends Controller<ViewChanInt<InfoS>, [number[]]> {
    private readonly memory: MemoryCtrl<InfoS>;

    constructor(version: string) {
        super(version);
        const apiChan = new ApiChan();
        const infoCon = new InfoCon(apiChan, toArrInfoStrRes);
        const getId = (res: InfoS) => {
            const [culId] = res;
            return culId;
        };
        const dataReq = (
            status: ServerStatusInt,
            cha: ViewChanInt<InfoS>,
            culIds: number[]
        ) => {
            this.reloadWindowOrCb(status.version, () => {
                infoCon.initInfo(cha, culIds, QApiCon.strMin);
            });
        };
        this.memory = new MemoryCtrl<InfoS>(getId, dataReq);
    }

    public override init(cha: ViewChanInt<InfoS>, args: number[]): void {
        this.memory.init(cha, args);
    }
}

export default InfoStrCtrl;
