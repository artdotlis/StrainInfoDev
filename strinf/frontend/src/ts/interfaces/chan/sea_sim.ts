// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { LoadStMInt } from '@strinf/ts/interfaces/dom/global';
import type { SeaTMInt } from '@strinf/ts/interfaces/dom/sea_sim';

type ViewChanInt = SeaTMInt & LoadStMInt;

export default ViewChanInt;
