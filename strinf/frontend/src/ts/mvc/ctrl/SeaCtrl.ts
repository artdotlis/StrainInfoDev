// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { ServerStatusJT } from '@strinf/ts/interfaces/api/data';
import type ViewChanInt from '@strinf/ts/interfaces/chan/sea';
import Known500Error from '@strinf/ts/errors/known/500';
import getServerStatus from '@strinf/ts/functions/api/status';
import onPrError from '@strinf/ts/functions/err/async';
import ApiChan from '@strinf/ts/mvc/ctrl/chan/ApiChan';
import Controller from '@strinf/ts/mvc/ctrl/Controller';
import SeaTable from '@strinf/ts/mvc/model/sea/SeaTable';

class SeaCtrl extends Controller<ViewChanInt, [string, string]> {
    private readonly apiChan: ApiChan;

    constructor(version: string) {
        super(version);
        this.apiChan = new ApiChan();
    }

    public override init(cha: ViewChanInt, args: string, api: string): void {
        const errC = new Known500Error('Internal server error!');
        const dataReq = (status: ServerStatusJT): void => {
            this.reloadWindowOrCb(status.version, () => {
                const seaTable = new SeaTable(this.apiChan);
                seaTable.initSea(cha, args, api);
            });
        };
        getServerStatus(dataReq, () => {
            onPrError(errC);
        });
    }
}

export default SeaCtrl;
