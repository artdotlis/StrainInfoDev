import { useContext } from 'preact/hooks';
import type { JSX } from 'preact';
import { ClHtml, Tex } from '@strinf/ts/constants/style/ClHtml';
import { filterArrRowStr, filterRowStr } from '@strinf/ts/functions/arr/parse';
import type { DesT, RelT } from '@strinf/ts/interfaces/api/mapped';
import type { InValInt, InValStInt } from '@strinf/ts/interfaces/dom/inp';
import { TooltipWrapper, createRDepTiles } from '@strinf/ts/mvc/vdom/fun/tab/pass';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import tilSty from '@strinf/css/mods/tile.module.css';
import type {
    DatIdTVInt,
    TTSrcTVInt,
    TT_GL_TYPE,
} from '@strinf/ts/interfaces/dom/tooltip';
import type AncT from '@strinf/ts/interfaces/misc/anchor';
import IdAcrTagCon from '@strinf/ts/constants/acr/id_acr';
import { SR_CUL_ID } from '@strinf/ts/constants/regexp/sea_reg';
import { getInfoDesTuple } from '@strinf/ts/functions/api/map';
import IdHtmlTour from '@strinf/ts/constants/tour/IdHtml';
import { PureComponent } from 'preact/compat';
import { createSimpleTiles } from '@strinf/ts/mvc/vdom/fun/tab/misc';

interface ResProps {
    detAnc: string;
    rel: RelT[];
    des: DesT[];
    curId: number;
    hookDep: TTSrcTVInt & DatIdTVInt<TT_GL_TYPE>;
    hookInf: TTSrcTVInt & DatIdTVInt<TT_GL_TYPE>;
}

const TIT = 'Deposits';
const ID = 'section_nav_rel_cul';

function getAnc4Det(): string {
    return ID;
}

interface TProps {
    rel: RelT[];
    des: DesT[];
    detAnc: string;
    curId: number;
    culH: TTSrcTVInt & DatIdTVInt<TT_GL_TYPE>;
    desH: TTSrcTVInt & DatIdTVInt<TT_GL_TYPE>;
}

function createTiles(
    tiles: [JSX.Element, number][],
    hook: TTSrcTVInt & DatIdTVInt<TT_GL_TYPE>,
    addInd: number
): JSX.Element[] {
    return tiles.map((til, ind: number) => (
        <TooltipWrapper
            key={ind + addInd}
            chi={til[0]}
            srcH={hook}
            upD={() => {
                if (hook.data !== undefined) {
                    hook.data(til[1]);
                }
            }}
        />
    ));
}

function createTilesDes(
    tiles: [JSX.Element, number][],
    hook: TTSrcTVInt & DatIdTVInt<TT_GL_TYPE>,
    addInd: number,
    desCon: string[]
): JSX.Element[] {
    const desLocCon = desCon;
    return tiles.map((til, ind: number) => (
        <TooltipWrapper
            key={ind + addInd}
            chi={til[0]}
            srcH={hook}
            upD={() => {
                if (hook.data !== undefined) {
                    hook.data(
                        <div>
                            <b>{getInfoDesTuple()}</b>
                            {': '}
                            {desLocCon[til[1]] ?? '...'}
                        </div>
                    );
                }
            }}
        />
    ));
}

function Table({ detAnc, curId, culH, desH, des, rel }: TProps): JSX.Element | null {
    const ctx: InValStInt | undefined = useContext(MainConGl);
    const tilesCul = createRDepTiles(
        rel,
        (dat: RelT) => [dat[0], dat[1], dat[3] === undefined, dat[4]],
        ctx,
        [detAnc, curId]
    );
    const tilesDes = createSimpleTiles(des, (val: string) => [val, Tex.m]).map(
        (val, ind): [JSX.Element, number] => [val, ind]
    );
    if (tilesCul.length === 0 && tilesDes.length === 0) {
        return null;
    }
    const tilesC = createTiles(tilesCul, culH, 0);
    const tilesD = createTilesDes(tilesDes, desH, tilesC.length, des);
    const cla = `${ClHtml.tils} ${tilSty.tilestext}`;
    return <div className={cla}>{[...tilesC, ...tilesD]}</div>;
}

function getAnchorR(ord: number, rel: RelT[]): AncT {
    if (rel.length > 0) {
        return { [ord]: [ID, TIT] };
    }
    return {};
}

interface RelState {
    selID: number;
}

class RelationsVD extends PureComponent<ResProps, RelState> {
    constructor(props: ResProps) {
        super(props);
        this.state = { selID: props.curId };
    }

    private preFetchInfo(rel: RelT[]): void {
        const { hookDep: hookCul } = this.props;
        for (const [siCu] of rel) {
            hookCul.data?.(siCu);
        }
    }

    public render(): JSX.Element | null {
        const ctx: InValInt | undefined = this.context;
        ctx?.inValSet('RelationsVD')((val: string) => {
            const valInt = parseInt(
                val.replace(new RegExp(IdAcrTagCon.depId, 'i'), '').replace(/,.*/, ''),
                10
            );
            if (!Number.isNaN(valInt) && SR_CUL_ID.test(val)) {
                this.setState({ selID: valInt });
            }
        });
        const { rel, des, detAnc, hookDep: hookCul, hookInf } = this.props;
        const { selID } = this.state;
        const resFc = filterArrRowStr<RelT>(rel, [1]);
        const resFd = filterRowStr<DesT>(des);
        if (resFc.length === 0 && resFd.length === 0) {
            return null;
        }
        this.preFetchInfo(resFc);
        return (
            <div id={IdHtmlTour.passRel}>
                <h3 className={ClHtml.titSec}>
                    {TIT}
                    <span id={ID} />
                </h3>
                <section>
                    <Table
                        detAnc={detAnc}
                        rel={resFc}
                        des={resFd}
                        curId={selID}
                        culH={hookCul}
                        desH={hookInf}
                    />
                </section>
            </div>
        );
    }
}
RelationsVD.contextType = MainConGl;
export default RelationsVD;
export { getAnchorR, getAnc4Det };
