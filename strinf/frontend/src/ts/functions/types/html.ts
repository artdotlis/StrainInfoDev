// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import { hasProp } from '@strinf/ts/functions/types/arr';

function getFormSelValue(key: string, formEl: object): string {
    if (hasProp(key, formEl)) {
        const conV = formEl[key];
        if (conV instanceof HTMLSelectElement) {
            return conV.value;
        }
    }
    return '';
}

function getFormInputCheckValue(key: string, formEl: object): string {
    if (hasProp(key, formEl)) {
        const conV = formEl[key];
        if (conV instanceof HTMLInputElement) {
            return conV.checked ? conV.value : '';
        }
    }
    return '';
}

export { getFormInputCheckValue, getFormSelValue };
