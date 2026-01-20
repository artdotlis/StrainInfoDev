// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { DetailsR } from '@strinf/ts/interfaces/api/mapped';

type DetSetF = (setter: (res: DetailsR[]) => void) => void;
type DetF = (res: DetailsR[]) => void;

interface DetTSet {
    get resSet(): DetSetF;
}

interface DetTMInt {
    get res(): DetF;
}

type DetStInt = DetTMInt & DetTSet;

export type { DetF, DetSetF, DetStInt, DetTMInt };
