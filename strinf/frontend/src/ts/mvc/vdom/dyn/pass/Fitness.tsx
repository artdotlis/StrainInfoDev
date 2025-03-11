import PassAncId from '@strinf/ts/constants/page/pass';
import { Align, ClHtml, Col, Dis, Mar, Wid } from '@strinf/ts/constants/style/ClHtml';
import IdHtmlTour from '@strinf/ts/constants/tour/IdHtml';
import type { DetailsR, RelT } from '@strinf/ts/interfaces/api/maped';
import type AncT from '@strinf/ts/interfaces/misc/anchor';
import type DetailCtrl from '@strinf/ts/mvc/ctrl/DetailCtrl';
import { useContext, useRef, useState } from 'preact/hooks';
import type ViewChanInt from '@strinf/ts/interfaces/chan/details';
import scSty from '@strinf/css/mods/scroll.module.css';
import type { AxisScale, ScaleBand, Axis } from 'd3';
import { axisBottom, axisLeft, scaleBand, select } from 'd3';
import svgSty from '@strinf/css/mods/svg.module.css';
import { useTooltipForRef } from '@strinf/ts/mvc/vdom/fun/tab/pass';
import type { TTHookG } from '@strinf/ts/interfaces/dom/global';
import type { ToolTipHookInt, TT_GL_TYPE } from '@strinf/ts/interfaces/dom/tooltip';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import { TT_ID_SIM } from '@strinf/ts/mvc/vdom/dyn/tooltip/TTSimVD';
import ClHtmlI from '@strinf/ts/constants/icon/ClHtml';
import type { JSX } from 'preact';
import IdAcrTagCon from '@strinf/ts/constants/acr/id_acr';
import CONFIG from '@strinf/ts/configs/config';

const TIT = 'Strain confidence';
const ID = PassAncId.fit;

const M_SM = 12;
const M_LA = 80;

function getWH(numX: number, numY: number): [number, number] {
    return getWHIn(numX, numY).map((val) => val + M_SM + M_LA) as [number, number];
}

function getWHIn(numX: number, numY: number): [number, number] {
    const [wiC, heC] = [numX * 48, numY * 48];
    const fact = Math.max(wiC, heC);
    return [wiC * (500 / wiC) * (wiC / fact), heC * (500 / heC) * (heC / fact)];
}

function getAnchorF(ord: number, rel: RelT[]): AncT {
    // TODO currently disabled in production and stage
    if (CONFIG.production || CONFIG.stage) {
        return {};
    }
    if (rel.length > 3) {
        return { [ord]: [ID, TIT] };
    }
    return {};
}

function crUpdater(
    setDat: (con: Map<number, [string, string[]]>) => void,
    allIds: number
): ViewChanInt {
    const resCon = new Map<number, [string, string[]]>();
    const setter = setDat;
    const limit = allIds;
    return {
        res: (detRes: DetailsR[]): void => {
            for (const desRes of detRes) {
                const [ccNo, culID, relDes] = [desRes[2], desRes[3], desRes[21]];
                resCon.set(culID, [ccNo, relDes]);
            }
            if (resCon.size >= limit) {
                setter(resCon);
            }
        },
    };
}
interface AxisProps {
    transform: string;
    transLabel: string;
    scaleFn: (scale: AxisScale<string>) => Axis<string>;
    scaleB: ScaleBand<string>;
    tickSize: number;
}

function crScaleB(range: [number, number], domain: string[]): ScaleBand<string> {
    return scaleBand().range(range).domain(domain);
}

function AxisXY({
    transform,
    scaleFn,
    scaleB,
    transLabel,
    tickSize,
}: AxisProps): JSX.Element {
    const skip = Math.max(Math.floor(tickSize / 12), 1);
    return (
        <g
            ref={(dom) => {
                if (dom !== null) {
                    let cnt = 0;
                    select(dom)
                        .call(scaleFn(scaleB))
                        .selectAll('text')
                        .style('opacity', () => {
                            cnt++;
                            if (cnt % skip === 0) {
                                return 1;
                            }
                            return 0;
                        })
                        .style('text-anchor', 'end')
                        .attr('transform', `rotate(-40) ${transLabel}`);
                }
            }}
            transform={transform}
        ></g>
    );
}

function crFlatDom(data: Map<number, [string, string[]]>): Set<string> {
    const uniq = new Set<string>();
    for (const ele of data.values()) {
        const [ccNoL, desCon] = ele;
        uniq.add(ccNoL);
        for (const des of desCon) {
            uniq.add(des);
        }
    }
    return uniq;
}

function crDomainX(
    rel: RelT[],
    des: string[],
    data: Map<number, [string, string[]]>
): string[] {
    const ccno = rel.map(([, ccNo]) => ccNo);
    const uniq = new Set([...ccno, ...des]);
    return [...uniq.union(crFlatDom(data))];
}

function crDomainY(data: Map<number, [string, string[]]>): string[] {
    const uniq = new Set<string>();
    for (const ele of data.values()) {
        const [ccno] = ele;
        uniq.add(ccno);
    }
    return [...uniq];
}

interface HMProps {
    data: Map<number, [string, string[]]>;
    scX: ScaleBand<string>;
    scY: ScaleBand<string>;
    ttH: ToolTipHookInt<TT_GL_TYPE> | undefined;
    domY: string[];
    domX: string[];
}

function getComColor(empty: boolean, des: boolean) {
    if (des && empty) {
        return '#ededed';
    }
    if (des) {
        return '#b98900';
    }
    if (empty) {
        return 'white';
    }
    return '#ECAF00';
}

interface HMRectProp {
    yVa: string;
    xVa: string;
    empty: boolean;
    des: boolean;
    cnt: number;
    scX: ScaleBand<string>;
    scY: ScaleBand<string>;
    ttH: ToolTipHookInt<TT_GL_TYPE>;
}

function HMRect({ yVa, xVa, empty, des, cnt, ttH, scX, scY }: HMRectProp): JSX.Element {
    const ref = useRef<SVGRectElement>(null);
    useTooltipForRef(
        ref,
        ttH,
        () => {
            if (ttH.data !== undefined) {
                const val = empty ? 'x' : 'mentions';
                ttH.data(
                    <p>
                        <b>{yVa}</b> {val} <b>{xVa}</b>
                    </p>
                );
            }
        },
        [50, 50]
    );
    return (
        <rect
            ref={ref}
            key={cnt}
            x={scX(xVa)}
            y={scY(yVa)}
            width={`${scX.bandwidth()}`}
            height={`${scY.bandwidth()}`}
            className={svgSty.hover}
            style={{
                fill: getComColor(empty, des),
                opacity: 0.8,
                stroke: 'grey',
                strokeWidth: 0.4,
            }}
        />
    );
}

function HeatMap({ data, scX, scY, ttH, domY, domX }: HMProps): JSX.Element {
    const res = [];
    let cnt = 0;
    const caXY = new Set<string>();
    const caCcNo = new Set<string>();
    for (const [lCc, desCon] of data.values()) {
        caXY.add(`${lCc}-${lCc}`);
        caCcNo.add(lCc);
        for (const des of desCon) {
            caXY.add(`${lCc}-${des}`);
        }
    }
    for (const yVal of domY) {
        for (const xVal of domX) {
            cnt++;
            if (ttH === undefined) {
                continue;
            }
            res.push(
                <HMRect
                    yVa={yVal}
                    xVa={xVal}
                    empty={!caXY.has(`${yVal}-${xVal}`)}
                    des={!caCcNo.has(xVal)}
                    scX={scX}
                    scY={scY}
                    ttH={ttH}
                    cnt={cnt}
                />
            );
        }
    }
    return <g>{res}</g>;
}

interface HMCProps {
    domY: string[];
    domX: string[];
    data: Map<number, [string, string[]]>;
    draw: boolean;
}

function crRelInfo(ttH: ToolTipHookInt<TT_GL_TYPE>): void {
    if (ttH.data !== undefined) {
        ttH.data(<p>INFO - TODO</p>);
    }
}
interface FitSVGProps {
    domY: string[];
    domX: string[];
    data: Map<number, [string, string[]]>;
    ttH: ToolTipHookInt<TT_GL_TYPE>;
    widthIn: number;
    heightIn: number;
    width: number;
    height: number;
}

function FitnessSVG({
    domX,
    domY,
    data,
    ttH,
    widthIn,
    heightIn,
    width,
    height,
}: FitSVGProps): JSX.Element {
    const refI = useRef<HTMLElement>(null);
    useTooltipForRef(
        refI,
        ttH,
        () => {
            crRelInfo(ttH);
        },
        [50, 50]
    );
    const xScB = crScaleB([0, widthIn], domX);
    const yScB = crScaleB([heightIn, 0], domY);
    return (
        <>
            <h6>
                Deposit relations <i className={ClHtmlI.info} ref={refI}></i>
            </h6>
            <svg viewBox={`0 0 ${width} ${height}`} width={width} height={height}>
                <g transform={`translate(${M_LA}, ${M_SM})`}>
                    <HeatMap
                        data={data}
                        scX={xScB}
                        scY={yScB}
                        ttH={ttH}
                        domX={domX}
                        domY={domY}
                    />
                    <AxisXY
                        transform={`translate(0,${heightIn})`}
                        transLabel={`translate(-2,0)`}
                        scaleFn={axisBottom}
                        scaleB={xScB}
                        tickSize={domX.length}
                    />
                    <AxisXY
                        transform={''}
                        transLabel={`translate(0,-10)`}
                        scaleFn={axisLeft}
                        scaleB={yScB}
                        tickSize={domY.length}
                    />
                </g>
            </svg>
        </>
    );
}

function FitnessCompleteVD({ domX, domY, data, draw }: HMCProps): JSX.Element | null {
    const ctx: TTHookG<TT_GL_TYPE> | undefined = useContext(MainConGl);
    const ttH = ctx?.getTTHook(TT_ID_SIM);
    if (!draw || ttH === undefined) {
        return null;
    }
    const [widthIn, heightIn] = getWHIn(domX.length, domY.length);
    const [width, height] = getWH(domX.length, domY.length);
    return (
        <div className={Col.col}>
            <div
                style={{ minWidth: width }}
                className={`${ClHtml.til} ${Mar.lN10} ${Mar.rN0} ${Mar.tN0}`}
            >
                <FitnessSVG
                    domX={domX}
                    domY={domY}
                    data={data}
                    ttH={ttH}
                    widthIn={widthIn}
                    width={width}
                    height={height}
                    heightIn={heightIn}
                />
            </div>
        </div>
    );
}

interface MatProps {
    othRel: Map<number, [string, string[]]>;
    ccno: Set<string>;
    numFields: number;
    setFitDraw: () => void;
}

interface AltProps {
    altSiId: number[];
}

function MatchingCVD({ othRel, numFields, ccno, setFitDraw }: MatProps): JSX.Element {
    let fitP = <>-</>;
    if (numFields >= 3) {
        let fit = 0;
        for (const [, desCon] of othRel.values()) {
            fit += desCon.filter((des) => ccno.has(des)).length;
        }
        fitP = (
            <>
                <span className={`${Dis.dIFlex} ${Align.ac}`}>
                    {(fit / numFields).toFixed(3)}
                </span>
                <button
                    className={`${ClHtml.btn} ${ClHtml.pri}`}
                    type="button"
                    aria-label={'show confidence'}
                    onClick={setFitDraw}
                >
                    <i className={ClHtmlI.caretRB}></i>
                </button>
            </>
        );
    }
    return (
        <tr>
            <td>
                <span className={ClHtml.key}>Strain matching confidence</span>
                <div className={`${Dis.dIFlex} ${Align.jb} ${Wid.f}`}>{fitP}</div>
            </td>
        </tr>
    );
}

function AltSiIdVD({ altSiId }: AltProps): JSX.Element {
    let alt = <>-</>;
    if (altSiId.length > 0) {
        alt = <>{altSiId.join(',')}</>;
    }
    return (
        <tr>
            <td>
                <span className={ClHtml.key}>Alternative {IdAcrTagCon.strId}</span>
                <div>{alt}</div>
            </td>
        </tr>
    );
}
function FitnessDetails({
    altSiId,
    othRel,
    numFields,
    ccno,
    setFitDraw,
}: AltProps & MatProps): JSX.Element {
    return (
        <table className={`${ClHtml.tab} ${ClHtml.sm} ${ClHtml.hov}`}>
            <thead></thead>
            <tbody>
                <MatchingCVD
                    othRel={othRel}
                    numFields={numFields}
                    ccno={ccno}
                    setFitDraw={setFitDraw}
                />
                <AltSiIdVD altSiId={altSiId} />
            </tbody>
            <tfoot></tfoot>
        </table>
    );
}

interface FitProps {
    rel: RelT[];
    des: string[];
    dCtrl: DetailCtrl;
    altSiId: number[];
}

function FitnessVD({ rel, des, altSiId, dCtrl }: FitProps): JSX.Element | null {
    const [dat, setDat] = useState<Map<number, [string, string[]]>>(new Map());
    const [fitDraw, setFitDraw] = useState<boolean>(false);
    const miss = rel.filter(([culId]) => !dat.has(culId));
    const relations = rel;
    // TODO currently disabled in production and stage
    if (CONFIG.production || CONFIG.stage) {
        return null;
    }
    if (miss.length !== 0) {
        const upd = crUpdater((con: Map<number, [string, string[]]>) => {
            setDat(con);
        }, relations.length);
        dCtrl.init(
            upd,
            relations.map(([culID, ,]) => culID)
        );
        return null;
    }
    const domX = crDomainX(rel, des, dat);
    const domY = crDomainY(dat);
    return (
        <div id={IdHtmlTour.strainFitness} className={Col.col}>
            <h3 className={ClHtml.titSec}>
                {TIT}
                <span id={ID} />
            </h3>
            <section className={scSty.mobile}>
                <div className={ClHtml.row}>
                    <div className={Col.col} style={{ minWidth: 180 }}>
                        <FitnessDetails
                            othRel={dat}
                            numFields={domY.length * domY.length}
                            ccno={new Set(domY)}
                            setFitDraw={() => {
                                setFitDraw(!fitDraw);
                            }}
                            altSiId={altSiId}
                        />
                    </div>
                    <FitnessCompleteVD
                        data={dat}
                        domX={domX}
                        domY={domY}
                        draw={fitDraw}
                    />
                </div>
            </section>
        </div>
    );
}

export default FitnessVD;

export { getAnchorF };
