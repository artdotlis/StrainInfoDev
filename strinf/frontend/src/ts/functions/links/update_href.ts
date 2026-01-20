// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { InValFS, InValStInt } from '@strinf/ts/interfaces/dom/inp';

function updateHrefVal<T extends string | number>(
    search: T | T[],
    ctx: InValStInt | undefined
): void {
    const nVal = Array.isArray(search) ? (search[0] ?? 'unknown') : search;
    for (const eleF of ctx?.inVal ?? ([] as InValFS[])) {
        eleF(`${nVal}`);
    }
}

export default updateHrefVal;
