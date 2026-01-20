// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { PassR } from '@strinf/ts/interfaces/api/mapped';
import type { LoadStMInt } from '@strinf/ts/interfaces/dom/global';
import type LoadStVInt from '@strinf/ts/interfaces/dom/load';

type TabSetF = (setter: (tab: PassR) => void) => void;
type TabF = (tab: PassR) => void;

interface PassTSet {
    get tabSet(): TabSetF;
}

interface PassTMInt {
    get tab(): TabF;
}

type PassStInt = PassTMInt & PassTSet & LoadStMInt & LoadStVInt;

export type { PassStInt, PassTMInt, TabF, TabSetF };
