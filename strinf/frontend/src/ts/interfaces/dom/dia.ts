// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type DiaT from '@strinf/ts/constants/type/DiaT';
import type { ChartData, ChartKeyXY } from '@strinf/ts/interfaces/api/mapped';

interface DiaDataCPS {
    data: ChartData<number[] | string[]>;
    keys: ChartKeyXY;
}

type DiaConG = Partial<
    Record<
        DiaT,
        {
            keys: object;
            data: object;
        }
    >
>;

interface DiaCon extends DiaConG {
    [DiaT.CPS]?: DiaDataCPS;
}

type DiaSetF = (setter: (stats: DiaCon) => void) => void;
type DiaF = (stats: DiaCon) => void;

interface DiaSet {
    get confSet(): DiaSetF;
}

interface DiaMInt {
    get conf(): DiaF;
}

export type { DiaCon, DiaDataCPS, DiaF, DiaMInt, DiaSet, DiaSetF };
