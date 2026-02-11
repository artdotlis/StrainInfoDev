// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type ErrType from '@strinf/ts/constants/type/ErrT';
import type {
    BreadFS,
    BreadSetFS,
    CookieFS,
    CookieSetFS,
    GlStInt,
    LoadFS,
} from '@strinf/ts/interfaces/dom/global';
import type { InValFS } from '@strinf/ts/interfaces/dom/inp';
import type { ToolTipHookInt, TT_GL_TYPE } from '@strinf/ts/interfaces/dom/tooltip';
import type { RefObject } from 'preact';
import { createContext } from 'preact';

class GlobSt implements GlStInt<TT_GL_TYPE> {
    private breadH: Record<string, BreadFS>;

    private ttH: Record<string, ToolTipHookInt<TT_GL_TYPE>>;

    private readonly loadSeaH: Record<string, LoadFS>;

    private readonly inValH: Record<string, InValFS>;

    private readonly cookiesH: Record<string, CookieFS>;

    private inValCurH: string;

    private readonly wrapper: RefObject<HTMLDivElement>;

    private errTV?: ErrType;

    private errSV: [string, string];

    private ver = '';

    constructor(seaV: string, wrap: RefObject<HTMLDivElement>) {
        this.errSV = ['', ''];
        this.breadH = {};
        this.loadSeaH = {};
        this.inValH = {};
        this.cookiesH = {};
        this.ttH = {};
        this.inValCurH = seaV;
        this.wrapper = wrap;
        this.ver = '';
    }

    public setVersion(ver: string): void {
        this.ver = ver;
    }

    public get version(): string {
        return this.ver;
    }

    public get errT(): ErrType | undefined {
        return this.errTV;
    }

    public get errS(): [string, string] {
        return [...this.errSV];
    }

    public get load(): LoadFS[] {
        return Object.values(this.loadSeaH);
    }

    public get inVal(): InValFS[] {
        return Object.values(this.inValH);
    }

    public get inValCur(): string {
        return this.inValCurH;
    }

    public get bread(): BreadFS[] {
        return Object.values(this.breadH);
    }

    public get cookieActive(): CookieFS[] {
        return Object.values(this.cookiesH);
    }

    public wrapperAddClass(classList: string[]): void {
        this.wrapper.current?.classList.add(...classList);
    }

    public wrapperRmClass(classList: string[]): void {
        this.wrapper.current?.classList.remove(...classList);
    }

    public errSSet(msg: string, customMsg: string): void {
        this.errSV = [msg, customMsg];
    }

    public errTSet(typ: ErrType): void {
        this.errTV = typ;
    }

    public loadSet(id: string): (setter: LoadFS) => void {
        return (setter: LoadFS): void => {
            this.loadSeaH[id] = setter;
        };
    }

    public ttHookSet(id: string): (hook: ToolTipHookInt<TT_GL_TYPE>) => void {
        return (hook: ToolTipHookInt<TT_GL_TYPE>): void => {
            this.ttH[id] = hook;
        };
    }

    public getTTHook(id: string): ToolTipHookInt<TT_GL_TYPE> | undefined {
        return this.ttH[id];
    }

    public inValSet(id: string): (setter: InValFS) => void {
        return (setter: InValFS): void => {
            this.inValH[id] = setter;
        };
    }

    public setInValCur(val: string): void {
        this.inValCurH = val;
    }

    public cookieActiveSet(id: string, cookie: CookieSetFS): void {
        this.cookiesH[id] = cookie;
    }

    public breadSet(id: string): BreadSetFS {
        return (setter: BreadFS): void => {
            this.breadH[id] = setter;
        };
    }
}

const MainConContext = createContext<GlStInt<TT_GL_TYPE> | undefined>(undefined);

export default GlobSt;
export { MainConContext };
