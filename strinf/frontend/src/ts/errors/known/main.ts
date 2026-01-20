// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import ErrType from '@strinf/ts/constants/type/ErrT';

class KnownError extends Error {
    private readonly typeV: ErrType;

    constructor(message: string, type?: ErrType) {
        super(message);
        this.name = 'KnownError';
        this.typeV = type ?? ErrType.EMain;
    }

    public get type(): ErrType {
        return this.typeV;
    }

    public get crit(): boolean {
        return ![ErrType.INWARN, ErrType.FEWARN].includes(this.typeV);
    }

    public get customMsg(): string {
        return this.message;
    }
}

export default KnownError;
