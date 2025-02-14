interface RelDataT {
    count: number;
    strains: {
        id: number;
        cultures: string[];
    }[];
}

type TabSetF = (setter: (tab: RelDataT) => void) => void;
type TabF = (tab: RelDataT) => void;

interface SeaRelTSet {
    get tabSet(): TabSetF;
}

interface SeaRelTMInt {
    get tab(): TabF;
}

type SeaRelStInt = SeaRelTMInt & SeaRelTSet;

export type { SeaRelStInt, SeaRelTMInt, TabSetF, TabF, RelDataT };
