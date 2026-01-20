// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

function isFunction(func: unknown): func is CallableFunction {
    return typeof func === 'function';
}

function onPrError(err: unknown): void {
    const onErrF = window.onerror;
    if (isFunction(onErrF)) {
        onErrF('', undefined, undefined, undefined, err);
    }
}

export default onPrError;
