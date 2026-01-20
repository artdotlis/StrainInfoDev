// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { ServerStatusJT } from '@strinf/ts/interfaces/api/data';
import type ViewChanInt from '@strinf/ts/interfaces/chan/ind';
import Known500Error from '@strinf/ts/errors/known/500';
import getServerStatus from '@strinf/ts/functions/api/status';
import onPrError from '@strinf/ts/functions/err/async';
import ApiChan from '@strinf/ts/mvc/ctrl/chan/ApiChan';
import Controller from '@strinf/ts/mvc/ctrl/Controller';
import DisConM from '@strinf/ts/mvc/model/charts/DisConM';
import DisCpsCnt from '@strinf/ts/mvc/model/charts/DisCpsCnt';
import StatsConM from '@strinf/ts/mvc/model/charts/StatsConM';

class IndCtrl extends Controller<ViewChanInt, [undefined]> {
    private readonly apiChan: ApiChan;

    private readonly statCon: StatsConM;

    private readonly disCon: DisConM;

    constructor(version: string) {
        super(version);
        this.apiChan = new ApiChan();
        this.statCon = new StatsConM(this.apiChan);
        this.disCon = new DisConM(this.apiChan, [new DisCpsCnt()]);
    }

    public override init(cha: ViewChanInt): void {
        const errC = new Known500Error('Internal server error!');
        const dataReq = (status: ServerStatusJT): void => {
            this.reloadWindowOrCb(status.version, () => {
                if (this.statCon.ready) {
                    this.statCon.initStats(cha.stat);
                }
                if (this.disCon.ready) {
                    this.disCon.initDis(cha.conf);
                }
            });
        };
        getServerStatus(dataReq, () => {
            onPrError(errC);
        });
    }
}

export default IndCtrl;
