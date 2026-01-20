// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { LoadStMInt } from '@strinf/ts/interfaces/dom/global';
import type { ProgStMInt } from '@strinf/ts/interfaces/dom/prog';
import type { SeaTMInt } from '@strinf/ts/interfaces/dom/sea';

type ViewChanInt = ProgStMInt & SeaTMInt & LoadStMInt;

export default ViewChanInt;
