// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { DiaCon } from '@strinf/ts/interfaces/dom/dia';

interface DisChartT {
    get api(): string;
    config: (call: string) => Promise<DiaCon>;
}

export default DisChartT;
