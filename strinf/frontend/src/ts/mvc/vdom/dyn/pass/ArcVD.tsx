// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { ArcT } from '@strinf/ts/interfaces/api/mapped';
import type { ToolTipHookInt, TT_GL_TYPE } from '@strinf/ts/interfaces/dom/tooltip';
import type AncT from '@strinf/ts/interfaces/misc/anchor';
import type { TableProps } from '@strinf/ts/mvc/vdom/dyn/table/Table';
import type { JSX } from 'preact';
import PassAncId from '@strinf/ts/constants/page/pass';
import { Align, ClHtml, Dis, Font } from '@strinf/ts/constants/style/ClHtml';
import IdHtmlTour from '@strinf/ts/constants/tour/IdHtml';
import { getArcTuple } from '@strinf/ts/functions/api/map';
import { defaultSort, sortDate } from '@strinf/ts/functions/arr/sort';
import { createDate } from '@strinf/ts/functions/parse/date';
import DoiDownloadGrid from '@strinf/ts/mvc/vdom/dyn/pass/link/DoiDownloadGrid';
import TableCon, { SearchWr } from '@strinf/ts/mvc/vdom/dyn/table/Table';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import { memo } from 'preact/compat';

interface ResProps {
    res: ArcT[];
    hook: ToolTipHookInt<TT_GL_TYPE>;
}

const TIT = 'Archive';
const ID = PassAncId.arc;

function getAnchorA(ord: number, rel: ArcT[]): AncT {
    if (rel.length > 0) {
        return { [ord]: [ID, TIT] };
    }
    return {};
}

function crDoi(row: ArcT | undefined, hook: ToolTipHookInt<TT_GL_TYPE>) {
    if (row === undefined) {
        return null;
    }
    const [doi, , , online] = row;
    return (
        <span className={Font.norm}>
            <span id={ID} />
            <DoiDownloadGrid doi={doi} online={online} hook={hook} />
        </span>
    );
}
const TIF = `
The DOI is currently not online, but will be published at a future date.
`;
function crTitle(row: ArcT | undefined): JSX.Element | null {
    if (row === undefined) {
        return null;
    }
    const [, title, , online] = row;
    let buf = title;
    if (!online) {
        buf += ` - ${TIF}`;
    }
    return <span className={Font.norm}>{buf}</span>;
}

function crDate(row: ArcT | undefined): JSX.Element | null {
    if (row === undefined) {
        return null;
    }
    return <span className={Font.norm}>{row[2]}</span>;
}

interface ArcProps extends TableProps<ArcT> {
    hook: ToolTipHookInt<TT_GL_TYPE>;
}

class ArcTable extends TableCon<ArcT, ArcProps> {
    protected override sort(index: number, sort: number): number[] {
        const { view } = this.state;
        const getV = (datPos: number): string => {
            return String(this.data[datPos]?.[index] ?? '');
        };
        const sDate = (fir: number, sec: number): number =>
            sortDate(sort, getV(fir), getV(sec));
        const sDef = (fir: number, sec: number): number =>
            defaultSort<string>(sort, getV(fir), getV(sec));
        switch (index) {
            case 2:
                view.sort(sDate);
                break;
            default:
                view.sort(sDef);
        }
        return view;
    }

    protected override search(filter: string, limit: number[]): number[] {
        const prepFilter = filter.toLocaleLowerCase();
        return limit.filter((ind: number) => {
            const val = this.data[ind];
            if (val === undefined) {
                return false;
            }
            const [doi, title, date] = val;
            if (
                doi.toLocaleLowerCase().includes(prepFilter) ||
                date.toLocaleLowerCase().includes(prepFilter) ||
                title.toLocaleLowerCase().includes(prepFilter)
            ) {
                return true;
            }
            return false;
        });
    }

    protected override renderTableBody(): JSX.Element {
        const { hook } = this.props;
        return (
            <tbody>
                {this.body.map((val: ArcT | undefined, index) => {
                    return (
                        <tr key={index}>
                            <th>{crDoi(val, hook)}</th>
                            <th>{crTitle(val)}</th>
                            <th>{crDate(val)}</th>
                        </tr>
                    );
                })}
            </tbody>
        );
    }

    protected override renderWindow(): JSX.Element | null {
        return null;
    }

    protected override renderInput(): JSX.Element | null {
        return (
            <div className={`${Dis.dFlex} ${Align.js}`}>
                <SearchWr
                    val={this.searchState.next}
                    set={(sea: string) => {
                        this.searchAction(sea);
                    }}
                />
            </div>
        );
    }

    protected override filter(_val: unknown, limit: number[]): number[] {
        return limit;
    }
}

ArcTable.contextType = MainConGl;

function modDate(
    arc: [string, string, string, boolean][]
): [string, string, string, boolean][] {
    return arc.map(([doi, tit, dat, online]) => [doi, tit, createDate(dat), online]);
}

function ArcVD({ res, hook }: ResProps): JSX.Element | null {
    if (res.length === 0) {
        return null;
    }

    return (
        <div id={IdHtmlTour.passArc}>
            <h3 className={ClHtml.titSec}>
                {TIT}
                <span id={ID} />
            </h3>
            <section>
                <ArcTable
                    res={modDate(res)}
                    window={15}
                    head={getArcTuple().map((val, index) => [index, val, true])}
                    tableCl={`${ClHtml.tab}  ${ClHtml.hov}`}
                    hook={hook}
                />
            </section>
        </div>
    );
}

export default memo(ArcVD);
export { getAnchorA };
