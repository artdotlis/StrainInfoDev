import type { InValStInt } from '@strinf/ts/interfaces/dom/inp';
import type { TTSrcTVInt } from '@strinf/ts/interfaces/dom/tooltip';
import type { JSX, RefObject } from 'preact';
import tilSty from '@strinf/css/mods/tile.module.css';
import { TT_TAR } from '@strinf/ts/constants/style/AtHtml';

import { BgCol, ClHtml, Font, Tex } from '@strinf/ts/constants/style/ClHtml';
import Known500Error from '@strinf/ts/errors/known/500';
import {
    createDepositTile,
    createStrainTile,
    parseVal2Html,
} from '@strinf/ts/mvc/vdom/fun/tab/misc';
import crToolTip from '@strinf/ts/mvc/vdom/fun/tooltip/tooltip';
import { useEffect, useRef } from 'preact/hooks';

const TAB_GEN = `${ClHtml.tab} ${ClHtml.sm} ${ClHtml.hov}`;

function createDefTable(
    header: JSX.Element | null,
    rows: JSX.Element[],
    colGr: JSX.Element[],
): JSX.Element {
    return (
        <table className={TAB_GEN}>
            <colgroup>{colGr}</colgroup>
            <thead>{header}</thead>
            <tbody>{rows}</tbody>
        </table>
    );
}

function appendTitleRow(
    header: string | JSX.Element,
    value: unknown,
    exCl: string,
): JSX.Element {
    return (
        <div key={header} className={`${ClHtml.row} ${exCl}`}>
            <span className={ClHtml.tit}>{header}</span>
            {parseVal2Html(value)}
        </div>
    );
}

function createStrainTitleBar(
    headers: (string | JSX.Element)[],
    values: unknown[],
    exCl: string[],
): JSX.Element[] {
    const con = [];
    for (let ind = 0; ind < values.length; ind += 1) {
        const val = values[ind];
        const head = headers[ind];
        const cla = exCl[ind];
        if (val === undefined || head === undefined || cla === undefined) {
            throw new Known500Error(
                `headers [${JSON.stringify(headers)}] and values [${values}] are mismatched!`,
            );
        }
        con.push(appendTitleRow(head, val, cla));
    }
    return con;
}

function createXColTable<T>(
    values: [string, T, number][][],
    parser: (val: T, key: string) => JSX.Element | null,
    colGr: JSX.Element[],
): [JSX.Element, number] {
    const rows = [];
    for (let row = 0; row < values.length; row += 1) {
        const rowEl = values[row] ?? [];
        const columns = [];
        for (const [key, val, spanN] of rowEl) {
            columns.push(
                <td colSpan={spanN}>
                    <span className={ClHtml.key}>{key}</span>
                    {parser(val, key)}
                </td>,
            );
        }
        rows.push(<tr key={row}>{columns}</tr>);
    }
    return [createDefTable(null, rows, colGr), rows.length];
}

function tileClass(curId: number, selId: number, bold: boolean, mark: boolean): string {
    let classNames = '';
    if (curId === selId) {
        classNames = `${Tex.w} ${BgCol.prim}`;
    }
    if (bold) {
        classNames += ` ${Font.bold}`;
    }
    if (mark) {
        classNames += ` ${tilSty.tilesmark}`;
    }
    return classNames;
}

interface TTWrProps {
    chi: JSX.Element;
    srcH: TTSrcTVInt;
    upD: () => void;
}

type EventsSt = [() => void, string, Element][];

function TooltipWrapper(props: TTWrProps): JSX.Element {
    const { srcH, upD, chi } = props;
    const tarRef = useRef<HTMLDivElement>(null);
    const events = useRef<EventsSt>([]);
    const storeEv = (eve: EventsSt) => {
        events.current.splice(0, events.current.length);
        events.current.push(...eve);
    };
    for (const eve of events.current) {
        if (eve[1] === 'blur') {
            eve[0]();
        }
        eve[2].removeEventListener(eve[1], eve[0]);
    }
    useEffect((): void => crToolTip([tarRef, srcH], upD, storeEv), [srcH, upD]);
    return (
        <div ref={tarRef} {...TT_TAR}>
            {chi}
        </div>
    );
}

function useTooltipForRef<T extends Element>(
    ref: RefObject<T>,
    srcH: TTSrcTVInt,
    upD: () => void,
    timeout: [number, number],
): void {
    const events = useRef<EventsSt>([]);
    const storeEv = (eve: EventsSt) => {
        events.current.splice(0, events.current.length);
        events.current.push(...eve);
    };
    for (const eve of events.current) {
        if (eve[1] === 'blur') {
            eve[0]();
        }
        eve[2].removeEventListener(eve[1], eve[0]);
    }
    crToolTip([ref, srcH], upD, storeEv, 0, timeout);
}

type TILE = (
    anc: string,
    val: [number, number, string],
    ctx: InValStInt | undefined,
    exCl: string,
) => JSX.Element;

function createTiles<T>(
    values: T[],
    parser: (val: T) => [number, string, boolean, boolean],
    ctx: InValStInt | undefined,
    props: [string, number],
    tile: TILE,
): [JSX.Element, number][] {
    const tiles: [JSX.Element, number][] = [];
    const [anc, curId] = props;
    for (let ind = 0; ind < values.length; ind += 1) {
        const val = values[ind];
        if (val === undefined) {
            throw new Known500Error(`values [${values}] are undefined!`);
        }
        const [tid, name, bold, mark] = parser(val);
        tiles.push([
            tile(
                anc === '' ? '' : `#${anc}`,
                [ind, tid, name],
                ctx,
                tileClass(curId, tid, bold, mark),
            ),
            tid,
        ]);
    }
    return tiles;
}

function createRDepTiles<T>(
    values: T[],
    parser: (val: T) => [number, string, boolean, boolean],
    ctx: InValStInt | undefined,
    props: [string, number],
): [JSX.Element, number][] {
    return createTiles(values, parser, ctx, props, createDepositTile);
}

function createRStrTiles(
    values: number[],
    parser: (val: number) => [number, string],
    ctx: InValStInt | undefined,
): [JSX.Element, number][] {
    return createTiles(
        values,
        val => [...parser(val), false, false],
        ctx,
        ['', -1],
        createStrainTile,
    );
}

export {
    createRDepTiles,
    createRStrTiles,
    createStrainTitleBar,
    createXColTable,
    TooltipWrapper,
    useTooltipForRef,
};
