import { useContext } from 'preact/hooks';
import type { JSX } from 'preact';
import { ClHtml, DdM, Wid } from '@strinf/ts/constants/style/ClHtml';
import { createKnownSeaCall } from '@strinf/ts/functions/links/create_sea';
import updateHrefVal from '@strinf/ts/functions/links/update_href';
import type { InValStInt } from '@strinf/ts/interfaces/dom/inp';
import getDDExp, { getDDRes } from '@strinf/ts/mvc/vdom/fun/sea/drop_down';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import type { SeaIndR } from '@strinf/ts/interfaces/api/maped';

import linkSty from '@strinf/css/mods/link.module.css';
import dropdown from '@strinf/css/mods/dropdown.module.css';
import { routeUri } from '@strinf/ts/functions/http/http';
import { addTagToInput } from '@strinf/ts/mvc/vdom/fun/sea/input';

function clickEvent(
    ctx: InValStInt | undefined,
    searchValue: string,
    searchApi: string
): void {
    const url = createKnownSeaCall(searchValue, searchApi);
    updateHrefVal(addTagToInput(searchValue, searchApi), ctx);
    routeUri(url, url);
}

function crRow(
    expE: [string, JSX.Element | string, string, string],
    ctx: InValStInt | undefined
): JSX.Element {
    const [key, displayValue, searchValue, searchApi] = expE;
    return (
        <button
            type="button"
            className={linkSty.cleanbutton}
            onClick={() => {
                clickEvent(ctx, searchValue, searchApi);
            }}
            onTouchEnd={() => {
                clickEvent(ctx, searchValue, searchApi);
            }}
        >
            <span className={DdM.t}>{key}</span>
            <span className={DdM.r}>{displayValue}</span>
        </button>
    );
}

interface DropProps {
    results: SeaIndR;
    input: string;
}

interface WrapProps {
    children: (JSX.Element | JSX.Element[])[];
    height: string;
}

function MainDropWr({ children, height }: WrapProps): JSX.Element {
    let drDCl = `${dropdown.dropdown} ${DdM.div} ${Wid.SM250}`;
    drDCl += Wid.MD400;
    return (
        <div className={drDCl} style={height}>
            {children}
        </div>
    );
}

function DropSeaVD({ results, input }: DropProps): JSX.Element | null {
    const ctx: InValStInt | undefined = useContext(MainConGl);
    const drHei = (getDDExp().length + 1) * 3.2;
    const height = `height: ${drHei}rem;`;
    let tit = 'Search examples';
    let resCon = getDDExp().map((val) => crRow([...val, ''], ctx));
    if (input !== '' && (results.exact.length > 0 || results.match.length > 0)) {
        const exact = getDDRes(results.exact, 6);
        const match = getDDRes(results.match, Math.max(6 - exact.length, 0));
        tit = 'Match found';
        resCon = [
            ...exact.map((valE) => crRow(valE, ctx)),
            ...match.map((valM) => crRow(valM, ctx)),
        ];
    }
    return (
        <MainDropWr height={height}>
            <div className={ClHtml.tit}>{tit}</div>
            {resCon}
        </MainDropWr>
    );
}
export default DropSeaVD;
