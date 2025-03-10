import type ViewChanInt from '@strinf/ts/interfaces/chan/info';
import InfoCon from '@strinf/ts/mvc/model/info/InfoCon';
import ApiChan from '@strinf/ts/mvc/ctrl/chan/ApiChan';
import type { InfoR, ServerStatusInt } from '@strinf/ts/interfaces/api/maped';
import QApiCon from '@strinf/ts/constants/api/q_api';
import Controller from '@strinf/ts/mvc/ctrl/Controller';
import MemoryCtrl from '@strinf/ts/mvc/ctrl/MemoryCtrl';

class InfoCtrl extends Controller<ViewChanInt, [number[]]> {
    private readonly memory: MemoryCtrl<InfoR>;

    constructor(version: string) {
        super(version);
        const apiChan = new ApiChan();
        const infoCon = new InfoCon(apiChan);
        const getId = (res: InfoR) => {
            const [culId] = res;
            return culId;
        };
        const dataReq = (status: ServerStatusInt, cha: ViewChanInt, culIds: number[]) => {
            this.reloadWindowOrCb(status.version, () => {
                infoCon.initInfo(cha, culIds, QApiCon.culMin);
            });
        };
        this.memory = new MemoryCtrl<InfoR>(getId, dataReq);
    }

    public override init(cha: ViewChanInt, args: number[]): void {
        this.memory.init(cha, args);
    }
}

export default InfoCtrl;
