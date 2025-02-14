type ProgSetF = (setter: (prog: number) => void) => void;
type ProgF = (prog: number) => void;

interface ProgSet {
    get progSet(): ProgSetF;
}
interface ProgStMInt {
    get prog(): ProgF;
}
export type { ProgSet, ProgStMInt, ProgSetF, ProgF };
