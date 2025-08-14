type InValFS = (val: string) => void;
type InValSetFS = (setter: InValFS) => void;
interface InValStInt {
    get inVal(): InValFS[];
    get inValCur(): string;
}
interface InValSet {
    inValSet: (id: string) => InValSetFS;
    setInValCur: (val: string) => void;
}

type InValInt = InValSet & InValStInt;

export type { InValFS, InValInt, InValStInt };
