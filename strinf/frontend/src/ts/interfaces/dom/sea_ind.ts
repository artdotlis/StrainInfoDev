import type { SeaIndR } from '@strinf/ts/interfaces/api/mapped';

type TabSetF = (setter: (tab: SeaIndR) => void) => void;
type TabF = (tab: SeaIndR) => void;

interface SeaIndTSet {
    get tabSet(): TabSetF;
}

interface SeaIndTMInt {
    get tab(): TabF;
}

type SeaIndStInt = SeaIndTMInt & SeaIndTSet;

export type { SeaIndStInt, SeaIndTMInt, TabSetF, TabF };
