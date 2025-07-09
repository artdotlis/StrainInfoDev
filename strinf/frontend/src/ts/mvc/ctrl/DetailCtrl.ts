import type ViewChanInt from '@strinf/ts/interfaces/chan/details';
import DetailsCon from '@strinf/ts/mvc/model/info/DetailsCon';
import ApiChan from '@strinf/ts/mvc/ctrl/chan/ApiChan';
import type { DetailsR, ServerStatusInt } from '@strinf/ts/interfaces/api/mapped';
import QApiCon from '@strinf/ts/constants/api/q_api';
import Controller from '@strinf/ts/mvc/ctrl/Controller';
import MemoryCtrl from '@strinf/ts/mvc/ctrl/MemoryCtrl';

class DetailCtrl extends Controller<ViewChanInt, [number[]]> {
    private readonly memory: MemoryCtrl<DetailsR>;

    constructor(version: string) {
        super(version);
        const apiChan = new ApiChan();
        const detCon = new DetailsCon(apiChan);
        const getId = (res: DetailsR) => {
            const [, , , culId] = res;
            return culId;
        };
        const dataReq = (status: ServerStatusInt, cha: ViewChanInt, culIds: number[]) => {
            this.reloadWindowOrCb(status.version, () => {
                detCon.initDetails(cha, culIds, QApiCon.culAvg);
            });
        };
        this.memory = new MemoryCtrl<DetailsR>(getId, dataReq);
    }

    public override init(cha: ViewChanInt, args: number[]): void {
        this.memory.init(cha, args);
    }
}

export default DetailCtrl;
