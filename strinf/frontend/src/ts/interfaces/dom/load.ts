import type { LoadFS } from '@strinf/ts/interfaces/dom/global';

interface LoadStVInt {
    setLoad: (load: () => LoadFS[]) => void;
}

export default LoadStVInt;
