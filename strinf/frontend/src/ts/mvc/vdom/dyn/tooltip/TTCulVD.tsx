import type { JSX, RefObject } from 'preact';
import { Component, createRef } from 'preact';
import { memo } from 'preact/compat';
import { HIDE_ATTR, TT_ARR, TT_SRC } from '@strinf/ts/constants/style/AtHtml';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import { getInfoTuple } from '@strinf/ts/functions/api/map';
import { filterArrStr } from '@strinf/ts/functions/arr/parse';
import type { InfoR } from '@strinf/ts/interfaces/api/maped';
import type { GlobVersionGet, TTHookS } from '@strinf/ts/interfaces/dom/global';
import InfoCtrl from '@strinf/ts/mvc/ctrl/InfoCtrl';
import { create2ColDiv, parseVal2Html } from '@strinf/ts/mvc/vdom/fun/tab/misc';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import InfoSt from '@strinf/ts/mvc/vdom/state/InfoSt';
import tooSty from '@strinf/css/mods/tooltip.module.css';
import IdAcrTagCon from '@strinf/ts/constants/acr/id_acr';
import type { TT_GL_TYPE, ToolTipHookInt } from '@strinf/ts/interfaces/dom/tooltip';
import ToolTipHook from '@strinf/ts/mvc/vdom/state/InfoHk';
import Known500Error from '@strinf/ts/errors/known/500';

interface ToolState {
    culId: number;
    res?: InfoR;
    info?: JSX.Element | undefined;
}

type EleT = number | boolean | string | string[] | JSX.Element;

const HEAD = getInfoTuple();
const TT_ID_CUL = 'tooltip_culture_id';

interface ToolTipProps {
    res: InfoR;
    loading: boolean;
    info: JSX.Element | undefined;
}

function crToolTipC(res: JSX.Element): JSX.Element {
    return (
        <div className={ClHtml.con}>
            <div className={ClHtml.cnt}>{res}</div>
        </div>
    );
}

function ToolTipC({ res, loading, info }: ToolTipProps): JSX.Element {
    const fixCul = [`${IdAcrTagCon.depId} ${res[0]}`, ...res.slice(1)];
    const filteredTT: [string[], EleT[]] = filterArrStr(HEAD, fixCul);
    const ind = filteredTT[0].indexOf(HEAD[2] ?? '');
    filteredTT[1][ind] = <i>{filteredTT[1][ind]}</i>;
    const resDiv = create2ColDiv<EleT | JSX.Element>(
        ...filteredTT,
        (val: EleT | JSX.Element) => {
            return parseVal2Html(val);
        }
    );
    if (resDiv[1] === 1 || loading) {
        resDiv[0] = <div key={0}>Loading ...</div>;
    }
    return crToolTipC(
        <>
            {resDiv[0]}
            {info ?? null}
        </>
    );
}

const ToolTipCM = memo(ToolTipC);

class ToolTipCulVD extends Component<object, ToolState> {
    private readonly modelH: InfoSt;

    private ctrl?: InfoCtrl;

    private readonly tooRef: RefObject<HTMLDivElement>;

    private readonly arrRef: RefObject<HTMLDivElement>;

    private loading: boolean;

    private readonly hook: ToolTipHookInt<TT_GL_TYPE>;

    private readonly buffer: Set<number>;

    constructor(props: object) {
        super(props);
        this.state = { culId: 0 };
        this.modelH = new InfoSt();
        this.loading = true;
        this.hook = new ToolTipHook();
        this.buffer = new Set<number>();
        this.modelH.resSet((results: InfoR[]): void => {
            for (const res of results) {
                const [locCid] = res;
                this.buffer.delete(locCid);
                const { culId } = this.state;
                if (culId === locCid) {
                    this.loading = false;
                    this.setState({ culId, res });
                }
            }
        });
        this.tooRef = createRef<HTMLDivElement>();
        this.arrRef = createRef<HTMLDivElement>();
    }

    private startInfo(ctx: GlobVersionGet): void {
        const { culId } = this.state;
        this.loading = this.buffer.has(culId);
        this.ctrl?.setVersion(ctx.version);
        if (this.ctrl === undefined) {
            this.ctrl = new InfoCtrl(ctx.version);
            this.ctrl.init(this.modelH, [...this.buffer.values()]);
        } else {
            this.ctrl.init(this.modelH, [...this.buffer.values()]);
        }
    }

    private initCtrl(): void {
        const ctx: (TTHookS<TT_GL_TYPE> & GlobVersionGet) | undefined = this.context;
        ctx?.ttHookSet(TT_ID_CUL)(this.hook);
        this.hook.dataSetter((culIdH: TT_GL_TYPE) => {
            const [selId, info] = Array.isArray(culIdH) ? culIdH : [culIdH, undefined];
            if (typeof selId !== 'number') {
                throw new Known500Error(
                    `deposit tooltips accept only numbers [${typeof culIdH}]`
                );
            }
            const { res } = this.state;
            let newState: ToolState = { culId: selId };
            if (res !== undefined) {
                newState = { res, culId: selId, info: info };
            }
            this.buffer.add(selId);
            this.setState(newState);
        });
        this.hook.setTTSrc([this.tooRef, this.arrRef]);
        if (ctx !== undefined && this.buffer.size > 0) {
            this.startInfo(ctx);
        }
    }

    public render(): JSX.Element {
        this.initCtrl();
        const { res, culId, info } = this.state;
        return (
            <div ref={this.tooRef} className={tooSty.tooltip} {...HIDE_ATTR} {...TT_SRC}>
                {culId === 0 || res === undefined ? null : (
                    <ToolTipCM res={res} loading={this.loading} info={info} />
                )}
                <div ref={this.arrRef} className={tooSty.arrow} {...TT_ARR} />
            </div>
        );
    }
}

ToolTipCulVD.contextType = MainConGl;

export default ToolTipCulVD;
export { TT_ID_CUL };
