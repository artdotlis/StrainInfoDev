// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { ServerStatusJT } from '@strinf/ts/interfaces/api/data';
import type { InfoR, InfoS } from '@strinf/ts/interfaces/api/mapped';
import type ViewChanInt from '@strinf/ts/interfaces/chan/info';
import ApiChan from '@strinf/ts/mvc/ctrl/chan/ApiChan';
import Controller from '@strinf/ts/mvc/ctrl/Controller';
import MemoryCtrl from '@strinf/ts/mvc/ctrl/MemoryCtrl';
import InfoCon from '@strinf/ts/mvc/model/info/InfoCon';

class InfoCtrl<T extends InfoS | InfoR> extends Controller<ViewChanInt<T>, [number[]]> {
    private readonly memory: MemoryCtrl<T>;

    constructor(version: string, parser: (data: unknown) => T, api: string) {
        super(version);
        const apiChan = new ApiChan();
        const infoCon = new InfoCon(apiChan, parser);
        const getId = (res: T) => {
            const [selId] = res;
            return selId;
        };
        const dataReq = (status: ServerStatusJT, cha: ViewChanInt<T>, ids: number[]) => {
            this.reloadWindowOrCb(status.version, () => {
                infoCon.initInfo(cha, ids, api);
            });
        };
        this.memory = new MemoryCtrl<T>(getId, dataReq);
    }

    public override init(cha: ViewChanInt<T>, args: number[]): void {
        this.memory.init(cha, args);
    }
}

export default InfoCtrl;
