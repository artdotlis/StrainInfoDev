// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import LEAD_TRAIL_COMMA from '@strinf/ts/constants/regexp/sep';
import ErrType from '@strinf/ts/constants/type/ErrT';
import KnownError from '@strinf/ts/errors/known/main';

class Known404Error extends KnownError {
    private static readonly split = ';-;';

    constructor(cat: string, sea: string) {
        const msgP = `${cat}${Known404Error.split}${decodeURIComponent(sea)}`;
        super(msgP, ErrType.E404);
        this.name = '404';
    }

    public static splitMsg(msg: string): [string, string] | null {
        const [cat, sea] = msg.split(Known404Error.split);
        if (cat !== undefined && sea !== undefined) {
            return [cat, sea.trim().replace(LEAD_TRAIL_COMMA, '')];
        }
        return null;
    }

    public override get customMsg(): string {
        return Known404Error.splitMsg(this.message)?.join(' - ') ?? 'unknown';
    }
}

export default Known404Error;
