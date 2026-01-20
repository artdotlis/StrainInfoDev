// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { SeaIndJT } from '@strinf/ts/interfaces/api/data';

type TabSetF = (setter: (tab: SeaIndJT) => void) => void;
type TabF = (tab: SeaIndJT) => void;

interface SeaIndTSet {
    get tabSet(): TabSetF;
}

interface SeaIndTMInt {
    get tab(): TabF;
}

type SeaIndStInt = SeaIndTMInt & SeaIndTSet;

export type { SeaIndStInt, SeaIndTMInt, TabF, TabSetF };
