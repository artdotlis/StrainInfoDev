// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import ErrType from '@strinf/ts/constants/type/ErrT';
import KnownError from '@strinf/ts/errors/known/main';

class Known500Error extends KnownError {
    constructor(message: string) {
        super(message, ErrType.E500);
        this.name = '500';
    }
}

export default Known500Error;
