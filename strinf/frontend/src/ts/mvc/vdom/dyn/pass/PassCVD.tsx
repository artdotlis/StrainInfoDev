import { Component } from 'preact';
import type { JSX } from 'preact';
import { memo, useState } from 'preact/compat';
import { ClHtml, Col } from '@strinf/ts/constants/style/ClHtml';
import type { DetailsR, PassR, RelT } from '@strinf/ts/interfaces/api/maped';
import type { TT_GL_TYPE, ToolTipHookInt } from '@strinf/ts/interfaces/dom/tooltip';
import DetailsVD, { getAnchorD } from '@strinf/ts/mvc/vdom/dyn/pass/DetailsVD';

import PubVD, { getAnchorP } from '@strinf/ts/mvc/vdom/dyn/pass/PubVD';
import RelationsVD, {
    getAnchorR,
    getAnc4Det,
} from '@strinf/ts/mvc/vdom/dyn/pass/RelationsVD';
import HistoryVD, { getAnchorH } from '@strinf/ts/mvc/vdom/dyn/pass/HistoryVD';
import SeqVD, { getAnchorS } from '@strinf/ts/mvc/vdom/dyn/pass/SeqVD';

import ArcVD, { getAnchorA } from '@strinf/ts/mvc/vdom/dyn/pass/ArcVD';
import PassNavVD from '@strinf/ts/mvc/vdom/dyn/pass/PassNavVD';
import createCVSchema from '@strinf/ts/mvc/vdom/fun/schema/pass';
import type DetailCtrl from '@strinf/ts/mvc/ctrl/DetailCtrl';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import type { TTHookG } from '@strinf/ts/interfaces/dom/global';
import { TT_ID_CUL } from '@strinf/ts/mvc/vdom/dyn/tooltip/TTCulVD';
import { TT_ID_SIM } from '@strinf/ts/mvc/vdom/dyn/tooltip/TTSimVD';
import type ViewChanInt from '@strinf/ts/interfaces/chan/details';
import { Helmet } from 'react-helmet';
import FitnessVD, { getAnchorF } from '@strinf/ts/mvc/vdom/dyn/pass/Fitness';

interface PassRProps {
    res: PassR | undefined;
    culId: string;
    dCtrl: DetailCtrl | undefined;
}

interface PassRVerified {
    res: PassR;
    culId: string;
    dCtrl: DetailCtrl;
}

interface ResProps {
    res: PassR;
    culId: string;
    hookCul: ToolTipHookInt<TT_GL_TYPE>;
    hookInf: ToolTipHookInt<TT_GL_TYPE>;
    dCtrl: DetailCtrl;
}

interface CulVProps {
    resCnt: number;
    culOv: JSX.Element;
    culDet: JSX.Element;
}

const REL_ORD = 1;
const DET_ORD = 2;
const HIS_ORD = 3;
const FIT_ORD = 4;
const SEQ_ORD = 5;
const PUB_ORD = 6;
const ARC_ORD = 7;

function createCultureRow(
    culOv: JSX.Element,
    culDet: JSX.Element,
    colCl: [string, string]
): JSX.Element {
    return (
        <div className={ClHtml.row}>
            <div className={colCl[0]}>{culOv}</div>
            <div className={colCl[1]}>{culDet}</div>
        </div>
    );
}

function CultureView({ resCnt, culOv, culDet }: CulVProps): JSX.Element {
    let colCl: [string, string] = [Col.lN3, Col.lN9];
    switch (true) {
        case resCnt <= 36:
            return createCultureRow(culOv, culDet, colCl);
        case resCnt <= 54:
            colCl = [Col.lN4, Col.lN8];
            return createCultureRow(culOv, culDet, colCl);
        default:
            return (
                <>
                    {culOv}
                    {culDet}
                </>
            );
    }
}

function selectCul(culId: number, rel: RelT[]): [number, string] {
    const def: [number, string] = [culId, ''];
    if (rel.length === 0) {
        return def;
    }
    for (const [cid, des] of rel) {
        if (cid === culId) {
            return [cid, des];
        }
    }
    const [ranId, ranDes] = rel[0] ?? def;
    return [ranId, ranDes];
}

function MainContainer({ res, culId, hookCul, hookInf, dCtrl }: ResProps): JSX.Element {
    const [selId, selDes] = selectCul(
        culId === '' ? 0 : parseInt(culId, 10),
        res.relations
    );
    const culOv = (
        <RelationsVD
            detAnc={getAnc4Det()}
            rel={res.relations}
            des={res.designations}
            curId={selId}
            hookCul={hookCul}
            hookInf={hookInf}
        />
    );
    const culDet = (
        <DetailsVD
            dCtrl={dCtrl}
            rel={res.relations}
            culId={selId}
            culDes={selDes}
            hookCul={hookCul}
            hookInf={hookInf}
        />
    );
    return (
        <div className={Col.lN9}>
            <CultureView
                resCnt={res.relations.length + res.designations.length}
                culDet={culDet}
                culOv={culOv}
            />
            <div className={ClHtml.row}>
                <HistoryVD
                    detAnc={getAnc4Det()}
                    hooks={hookCul}
                    rel={res.relations}
                    selCuId={selId}
                />
                <FitnessVD
                    rel={res.relations}
                    des={res.designations}
                    dCtrl={dCtrl}
                    altSiId={res.altStrIds}
                />
            </div>
            <SeqVD
                hookCul={hookCul}
                hookInf={hookInf}
                detAnc={getAnc4Det()}
                res={res.sequences}
            />
            <PubVD
                hookCul={hookCul}
                hookInf={hookInf}
                detAnc={getAnc4Det()}
                res={res.publications}
            />
            <ArcVD res={res.archive} />
        </div>
    );
}

const MainContVD = memo(MainContainer);

function Inner({ res, culId, hookCul, hookInf, dCtrl }: ResProps): JSX.Element {
    const anc = {
        ...getAnchorD(DET_ORD, res.relations),
        ...getAnchorR(REL_ORD, res.relations),
        ...getAnchorH(HIS_ORD, res.relations),
        ...getAnchorF(FIT_ORD, res.relations),
        ...getAnchorS(SEQ_ORD, res.sequences),
        ...getAnchorP(PUB_ORD, res.publications),
        ...getAnchorA(ARC_ORD, res.archive),
    };
    return (
        <>
            <MainContVD
                dCtrl={dCtrl}
                res={res}
                culId={culId}
                hookInf={hookInf}
                hookCul={hookCul}
            />
            <PassNavVD anc={anc} strId={res.allStrIds} taxN={res.overview[2][0]} />
        </>
    );
}

interface DataSetProps {
    res: PassR;
    dCtrl: DetailCtrl;
}

function crUpdater(
    setDat: (con: Map<number, string>) => void,
    allIds: number
): ViewChanInt {
    const resCon = new Map<number, string>();
    const setter = setDat;
    const limit = allIds;
    return {
        res: (detRes: DetailsR[]): void => {
            for (const [, , , culID, , , taxC] of detRes) {
                resCon.set(culID, taxC[0]);
            }
            if (resCon.size >= limit) {
                setter(resCon);
            }
        },
    };
}

function DataSet({ res, dCtrl }: DataSetProps): JSX.Element | null {
    const [dat, setDat] = useState<Map<number, string>>(new Map());
    const miss = res.relations.filter(([culId]) => !dat.has(culId));
    const { relations } = res;
    if (miss.length !== 0) {
        const upd = crUpdater((con: Map<number, string>) => {
            setDat(con);
        }, relations.length);
        dCtrl.init(
            upd,
            relations.map(([culID, ,]) => culID)
        );
        return null;
    }
    return (
        <Helmet>
            <script type="application/ld+json">
                {createCVSchema(res, [...dat.values()])}
            </script>
        </Helmet>
    );
}

function checkUndefined(props: PassRProps): props is PassRVerified {
    const { res, dCtrl } = props;
    if (res === undefined || dCtrl === undefined) {
        return false;
    }
    return true;
}

class PassCVD extends Component<PassRProps, object> {
    constructor(props: PassRProps) {
        super(props);
        this.state = {};
    }

    public render(): JSX.Element | null {
        const ctx: TTHookG<TT_GL_TYPE> | undefined = this.context;
        const hookCul = ctx?.getTTHook(TT_ID_CUL);
        const hookInf = ctx?.getTTHook(TT_ID_SIM);
        const verified = this.props;
        if (hookCul !== undefined && hookInf !== undefined && checkUndefined(verified)) {
            const { res, culId, dCtrl } = verified;
            return (
                <>
                    <DataSet dCtrl={dCtrl} res={res} />
                    <div className={ClHtml.row}>
                        <Inner
                            dCtrl={dCtrl}
                            res={res}
                            culId={culId}
                            hookCul={hookCul}
                            hookInf={hookInf}
                        />
                    </div>
                </>
            );
        }
        return null;
    }
}

PassCVD.contextType = MainConGl;

export default PassCVD;
