// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { SeaIndStInt, TabF, TabSetF } from '@strinf/ts/interfaces/dom/sea_ind';
import Known500Error from '@strinf/ts/errors/known/500';

class SeaIndSt implements SeaIndStInt {
    private tabH?: TabF;

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

export default SeaIndSt;
