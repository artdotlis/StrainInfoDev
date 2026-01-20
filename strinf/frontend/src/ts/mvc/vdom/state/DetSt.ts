// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { DetF, DetSetF, DetStInt } from '@strinf/ts/interfaces/dom/detail';
import Known500Error from '@strinf/ts/errors/known/500';

class DetSt implements DetStInt {
    private resH?: DetF;

    public get res(): DetF {
        if (this.resH === undefined) {
            throw new Known500Error('res setter was not initialized');
        }
        return this.resH;
    }

    public get resSet(): DetSetF {
        return (setter: DetF): void => {
            this.resH = setter;
        };
    }
}

export default DetSt;
