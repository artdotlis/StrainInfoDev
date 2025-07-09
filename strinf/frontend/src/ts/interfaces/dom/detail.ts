import type { DetailsR } from '@strinf/ts/interfaces/api/mapped';

type DetSetF = (setter: (res: DetailsR[]) => void) => void;
type DetF = (res: DetailsR[]) => void;

interface DetTSet {
    get resSet(): DetSetF;
}

interface DetTMInt {
    get res(): DetF;
}

type DetStInt = DetTMInt & DetTSet;

export type { DetTMInt, DetSetF, DetF, DetStInt };
