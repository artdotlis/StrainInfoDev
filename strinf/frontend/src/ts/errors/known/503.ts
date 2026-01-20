// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import ErrType from '@strinf/ts/constants/type/ErrT';
import KnownError from '@strinf/ts/errors/known/main';

class Known503Error extends KnownError {
    private readonly time_info: string;

    private readonly zone_info: string;

    private static readonly split = ';-;';

    constructor(message: string, time: string, zone: string) {
        super(Known503Error.formateMsg(message, time, zone), ErrType.E503);
        this.name = '503';
        this.zone_info = zone;
        this.time_info = time;
    }

    public get time(): string {
        return this.time_info;
    }

    public get zone(): string {
        return this.zone_info;
    }

    public static formateMsg(msg: string, time: string, zone: string): string {
        if (time !== '' || zone !== '') {
            return `${time}${Known503Error.split}${zone}`;
        }
        return msg;
    }

    public static splitMsg(msg: string): [string, string] | null {
        const [time, zone] = msg.split(Known503Error.split);
        if (time !== undefined && zone !== undefined) {
            return [time.trim(), zone.trim()];
        }
        return null;
    }
}

export default Known503Error;
