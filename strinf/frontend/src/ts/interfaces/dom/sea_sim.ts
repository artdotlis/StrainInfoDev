// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { SeaR } from '@strinf/ts/interfaces/api/mapped';
import type { LoadStMInt } from '@strinf/ts/interfaces/dom/global';
import type LoadStVInt from '@strinf/ts/interfaces/dom/load';

type TabSetF = (setter: (tab: SeaR[]) => void) => void;
type TabF = (tab: SeaR[]) => void;

interface SeaTSet {
    get tabSet(): TabSetF;
}

interface SeaTMInt {
    get tab(): TabF;
}

type SeaStInt = SeaTMInt & SeaTSet & LoadStMInt & LoadStVInt;

export type { SeaStInt, SeaTMInt, TabF, TabSetF };
