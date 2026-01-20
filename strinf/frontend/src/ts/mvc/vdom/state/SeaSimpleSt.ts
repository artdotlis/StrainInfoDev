// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { LoadFS } from '@strinf/ts/interfaces/dom/global';
import type { SeaStInt, TabF, TabSetF } from '@strinf/ts/interfaces/dom/sea_sim';
import Known500Error from '@strinf/ts/errors/known/500';

class SeaSimpleSt implements SeaStInt {
    private tabH?: TabF;

    private loadSeaH: () => LoadFS[];

    constructor() {
        this.loadSeaH = () => [];
    }

    public get load(): LoadFS[] {
        return this.loadSeaH();
    }

    public setLoad(load: () => LoadFS[]): void {
        this.loadSeaH = load;
    }

    public get tab(): TabF {
        if (this.tabH === undefined) {
            throw new Known500Error('tab setter was not initialized');
        }
        return this.tabH;
    }

    public get tabSet(): TabSetF {
        return (setter: TabF): void => {
            this.tabH = setter;
        };
    }
}

export default SeaSimpleSt;
