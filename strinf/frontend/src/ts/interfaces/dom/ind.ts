// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { DiaMInt, DiaSet } from '@strinf/ts/interfaces/dom/dia';
import type { DataCon } from '@strinf/ts/interfaces/dom/global';

type StaSetF = (setter: (stats: DataCon<number>[]) => void) => void;
type StaF = (stats: DataCon<number>[]) => void;

interface StaSet {
    get statSet(): StaSetF;
}

interface StaMInt {
    get stat(): StaF;
}

type IndStInt = StaSet & StaMInt & DiaSet & DiaMInt;

export type { IndStInt, StaF, StaMInt, StaSetF };
