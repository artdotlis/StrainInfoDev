import type { InfoR, InfoS } from '@strinf/ts/interfaces/api/mapped';
import type { JSX, RefObject } from 'preact';

type InfSetF<I extends InfoR | InfoS> = (setter: (res: I[]) => void) => void;
type InfF<I extends InfoR | InfoS> = (res: I[]) => void;

type DatIdSetF<T> = (setter: (did: T) => void) => void;
type DatIdF<T> = (did: T) => void;

interface InfoTSet<I extends InfoR | InfoS> {
    get resSet(): InfSetF<I>;
}

interface InfoTMInt<I extends InfoR | InfoS> {
    get res(): InfF<I>;
}

interface DatIdTVSet<T> {
    get dataSetter(): DatIdSetF<T>;
}

type TT_GL_TYPE = JSX.Element | number | [number, JSX.Element | string[]];

interface DatIdTVInt<T> {
    get data(): DatIdF<T> | undefined;
}

interface TTSrcTVSet {
    setTTSrc: (srcRef: [RefObject<HTMLDivElement>, RefObject<HTMLDivElement>]) => void;
}

interface TTSrcTVInt {
    get ttSrc(): [RefObject<HTMLDivElement>, RefObject<HTMLDivElement>] | undefined;
}

type InfoStInt<I extends InfoR | InfoS> = InfoTMInt<I> & InfoTSet<I>;

type ToolTipHookInt<T> = DatIdTVInt<T> & DatIdTVSet<T> & TTSrcTVSet & TTSrcTVInt;

export type {
    DatIdF,
    DatIdSetF,
    DatIdTVInt,
    InfF,
    InfoStInt,
    InfoTMInt,
    InfSetF,
    ToolTipHookInt,
    TT_GL_TYPE,
    TTSrcTVInt,
};
