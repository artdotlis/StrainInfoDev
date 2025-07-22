import type { DiaMInt, DiaSet } from '@strinf/ts/interfaces/dom/dia';
import type { DataCon } from '@strinf/ts/interfaces/dom/global';

type StaSetF = (setter: (stats: DataCon<number>[]) => void) => void;
type StaF = (stats: DataCon<number>[]) => void;

interface StaSet {
    get statSet(): StaSetF;
}

interface StaMInt {
    get stat(): StaF;
}

type IndStInt = StaSet & StaMInt & DiaSet & DiaMInt;

export type { IndStInt, StaF, StaSetF, StaMInt };
