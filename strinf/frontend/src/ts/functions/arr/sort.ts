// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

function sortDate(sort: number, first: string, second: string): number {
    let dif = 0;
    let firD = new Date(first).getTime();
    if (firD < 0) {
        dif = -1 * firD;
        firD = 0;
    }
    let secD = new Date(second).getTime() + dif;
    if (secD < 0) {
        dif += -1 * secD;
        [firD, secD] = [-1 * secD, 0];
    }
    return sort * (firD - secD);
}

function defaultSort<T>(sort: number, val1: T, val2: T): number {
    if (val1 === '') {
        return 1;
    }
    if (val2 === '') {
        return -1;
    }
    if (val1 === val2) {
        return 0;
    }
    if (typeof val1 === 'string' && typeof val2 === 'string') {
        return sort * val1.localeCompare(val2);
    }
    return sort * (val1 > val2 ? 1 : -1);
}

function strNumSort<T>(sort: number, val1: T, val2: T): number {
    if (typeof val1 !== 'string' || typeof val2 !== 'string') {
        return 0;
    }
    return (Number.parseInt(val1, 10) - Number.parseInt(val2)) * sort;
}

function numSort<T>(sort: number, val1: T, val2: T): number {
    if (typeof val1 !== 'number' || typeof val2 !== 'number') {
        return 0;
    }
    return (val1 - val2) * sort;
}
export { defaultSort, numSort, sortDate, strNumSort };
