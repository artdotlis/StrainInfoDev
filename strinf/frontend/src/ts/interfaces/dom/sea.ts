import type { SeaR } from '@strinf/ts/interfaces/api/mapped';
import type { LoadStMInt } from '@strinf/ts/interfaces/dom/global';
import type LoadStVInt from '@strinf/ts/interfaces/dom/load';
import type { ProgSet, ProgStMInt } from '@strinf/ts/interfaces/dom/prog';

type TabSetF = (setter: (tab: SeaR[]) => void) => void;
type TabF = (tab: SeaR[]) => void;

type ToPassSetF = (setter: (str: string, cul: string) => void) => void;
type ToPassF = (str: string, cul: string) => void;

interface SeaTSet {
    get tabSet(): TabSetF;
    get toPassSet(): ToPassSetF;
}

interface SeaTMInt {
    get tab(): TabF;
    get toPass(): ToPassF;
}

type SeaStInt = ProgSet & ProgStMInt & SeaTMInt & SeaTSet & LoadStMInt & LoadStVInt;

export type { SeaStInt, TabSetF, TabF, SeaTMInt, ToPassF, ToPassSetF };
