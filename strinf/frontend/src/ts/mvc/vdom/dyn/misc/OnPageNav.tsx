import { ClHtml, Col, Dis, ZInd } from '@strinf/ts/constants/style/ClHtml';
import type AncT from '@strinf/ts/interfaces/misc/anchor';
import { memo } from 'preact/compat';
import type { JSX } from 'preact';

interface PageNav {
    children: JSX.Element[];
    addCnt?: JSX.Element;
    tId?: string;
}

interface NavT {
    children: JSX.Element[];
}

function Nav({ children }: NavT): JSX.Element | null {
    if (children.length === 0) {
        return null;
    }
    return (
        <>
            <div className={ClHtml.tit}>On this page</div>
            {children}
        </>
    );
}

function OnPageNavVD({ children, addCnt, tId }: PageNav): JSX.Element {
    return (
        <div
            className={`${Col.lN3} ${Dis.dNone} ${Dis.dBL}`}
            {...(tId === undefined ? {} : { id: tId })}
        >
            <div className={`${ClHtml.pageNav} ${ZInd.N10}`}>
                <div className={ClHtml.cnt}>
                    <Nav>{children}</Nav>
                </div>
                {addCnt}
            </div>
        </div>
    );
}
OnPageNavVD.defaultProps = {
    addCnt: undefined,
    tId: undefined,
};

function createNavLinks(anc: AncT | undefined): JSX.Element[] {
    if (anc === undefined) {
        return [];
    }
    const res: JSX.Element[] = [];
    for (const key of Object.keys(anc)
        .sort()
        .map((ele) => Number(ele))) {
        const val = anc[key];
        if (val !== undefined) {
            res.push(
                <a key={val[0]} href={`#${val[0]}`}>
                    {val[1]}
                </a>
            );
        }
    }
    return res;
}

export default memo(OnPageNavVD);
export { createNavLinks };
