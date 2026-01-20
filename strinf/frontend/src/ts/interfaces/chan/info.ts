// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { InfoR, InfoS } from '@strinf/ts/interfaces/api/mapped';
import type { InfoTMInt } from '@strinf/ts/interfaces/dom/tooltip';

type ViewChanInt<I extends InfoS | InfoR> = InfoTMInt<I>;

export default ViewChanInt;
