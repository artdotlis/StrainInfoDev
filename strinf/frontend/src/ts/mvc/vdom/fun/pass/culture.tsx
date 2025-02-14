import type { InValStInt } from '@strinf/ts/interfaces/dom/inp';
import type { TT_GL_TYPE, ToolTipHookInt } from '@strinf/ts/interfaces/dom/tooltip';
import {
    DotTT,
    createPassCulHref,
    createRowElWTT,
} from '@strinf/ts/mvc/vdom/fun/tab/misc';
import { Align, Dis } from '@strinf/ts/constants/style/ClHtml';
import type { JSX } from 'preact';

type Events = [() => void, string, Element][];
type HOOK = ToolTipHookInt<TT_GL_TYPE>;
function formatCultureTT(
    anc: string,
    cultures: [string, number][],
    [hookCul, hookInf]: [HOOK, HOOK],
    ctx: InValStInt,
    tooltip: [(eve: Events) => void, Events]
): JSX.Element {
    const rowCh = cultures
        .slice(0, 2)
        .map((cde): [number, JSX.Element] => [
            cde[1],
            createPassCulHref([cde[1].toString(), cde[0]], ctx, `#${anc}`),
        ]);
    const rowEl = createRowElWTT({
        chi: rowCh,
        hooks: hookCul,
        stEv: tooltip[0],
        events: tooltip[1],
    });
    const data = cultures.slice(2).map(([ccno]) => ccno);
    if (data.length === 0) {
        return <div className={`${Dis.dFlex} ${Align.fc}`}>{rowEl}</div>;
    }
    return (
        <div className={`${Dis.dFlex} ${Align.fc}`}>
            {rowEl}
            <DotTT hook={hookInf} data={data} head="Designation" />
        </div>
    );
}
export default formatCultureTT;
