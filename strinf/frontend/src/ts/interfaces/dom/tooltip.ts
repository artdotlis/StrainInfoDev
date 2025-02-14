import type { RefObject, JSX } from 'preact';
import type { InfoR } from '@strinf/ts/interfaces/api/maped';

type InfSetF = (setter: (res: InfoR[]) => void) => void;
type InfF = (res: InfoR[]) => void;

type DatIdSetF<T> = (setter: (did: T) => void) => void;
type DatIdF<T> = (did: T) => void;

interface InfoTSet {
    get resSet(): InfSetF;
}

interface InfoTMInt {
    get res(): InfF;
}

interface DatIdTVSet<T> {
    get dataSetter(): DatIdSetF<T>;
}

type TT_GL_TYPE = JSX.Element | number | [number, JSX.Element];

interface DatIdTVInt<T> {
    get data(): DatIdF<T> | undefined;
}

interface TTSrcTVSet {
    setTTSrc: (srcRef: [RefObject<HTMLDivElement>, RefObject<HTMLDivElement>]) => void;
}

interface TTSrcTVInt {
    get ttSrc(): [RefObject<HTMLDivElement>, RefObject<HTMLDivElement>] | undefined;
}

type InfoStInt = InfoTMInt & InfoTSet;

type ToolTipHookInt<T> = DatIdTVInt<T> & DatIdTVSet<T> & TTSrcTVSet & TTSrcTVInt;

export type {
    ToolTipHookInt,
    InfoStInt,
    InfoTMInt,
    InfSetF,
    InfF,
    DatIdF,
    DatIdSetF,
    TTSrcTVInt,
    DatIdTVInt,
    TT_GL_TYPE,
};
