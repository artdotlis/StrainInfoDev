import type { JSX, RefObject } from 'preact';
import { Component, createRef } from 'preact';
import { HIDE_ATTR, TT_ARR, TT_SRC } from '@strinf/ts/constants/style/AtHtml';
import type { InfoR, InfoS } from '@strinf/ts/interfaces/api/mapped';
import type { GlobVersionGet, TTHookS } from '@strinf/ts/interfaces/dom/global';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import InfoSt from '@strinf/ts/mvc/vdom/state/InfoSt';
import tooSty from '@strinf/css/mods/tooltip.module.css';
import type { TT_GL_TYPE, ToolTipHookInt } from '@strinf/ts/interfaces/dom/tooltip';
import ToolTipHook from '@strinf/ts/mvc/vdom/state/InfoHk';
import Known500Error from '@strinf/ts/errors/known/500';
import type InfoCtrl from '@strinf/ts/mvc/ctrl/InfoCtrl';

interface ToolState<I extends InfoS | InfoR> {
    selId: number;
    res?: I;
    info?: JSX.Element | undefined;
}

interface ToolTipProps<I extends InfoS | InfoR> {
    res: I;
    loading: boolean;
    info: JSX.Element | undefined;
}

interface ToolProps<I extends InfoS | InfoR> {
    hookName: string;
    createCtrl: (ver: string) => InfoCtrl<I>;
    createTT: (props: ToolTipProps<I>) => JSX.Element;
}

class ToolTipInfoVD<I extends InfoS | InfoR> extends Component<
    ToolProps<I>,
    ToolState<I>
> {
    private readonly modelH: InfoSt<I>;

    private ctrl?: InfoCtrl<I>;

    private readonly tooRef: RefObject<HTMLDivElement>;

    private readonly arrRef: RefObject<HTMLDivElement>;

    private loading: boolean;

    private readonly hook: ToolTipHookInt<TT_GL_TYPE>;

    private readonly buffer: Set<number>;

    constructor(props: ToolProps<I>) {
        super(props);
        this.state = { selId: 0 };
        this.modelH = new InfoSt<I>();
        this.loading = true;
        this.hook = new ToolTipHook();
        this.buffer = new Set<number>();
        this.modelH.resSet((results: I[]): void => {
            for (const res of results) {
                const [locCid] = res;
                this.buffer.delete(locCid);
                const { selId } = this.state;
                if (selId === locCid) {
                    this.loading = false;
                    this.setState({ selId: selId, res });
                }
            }
        });
        this.tooRef = createRef<HTMLDivElement>();
        this.arrRef = createRef<HTMLDivElement>();
    }

    private startInfo(ctx: GlobVersionGet): void {
        const { selId } = this.state;
        this.loading = this.buffer.has(selId);
        this.ctrl?.setVersion(ctx.version);
        if (this.ctrl === undefined) {
            const { createCtrl } = this.props;
            this.ctrl = createCtrl(ctx.version);
            this.ctrl.init(this.modelH, [...this.buffer.values()]);
        } else {
            this.ctrl.init(this.modelH, [...this.buffer.values()]);
        }
    }

    private initCtrl(): void {
        const ctx: (TTHookS<TT_GL_TYPE> & GlobVersionGet) | undefined = this.context;
        const { hookName } = this.props;
        ctx?.ttHookSet(hookName)(this.hook);
        this.hook.dataSetter((culIdH: TT_GL_TYPE) => {
            const [selId, info] = Array.isArray(culIdH) ? culIdH : [culIdH, undefined];
            if (typeof selId !== 'number') {
                throw new Known500Error(
                    `deposit tooltips accept only numbers [${typeof culIdH}]`
                );
            }
            const { res } = this.state;
            let newState: ToolState<I> = { selId: selId };
            if (res !== undefined) {
                newState = { res, selId: selId, info: info };
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
        const { res, selId, info } = this.state;
        const { createTT } = this.props;
        return (
            <div ref={this.tooRef} className={tooSty.tooltip} {...HIDE_ATTR} {...TT_SRC}>
                {selId === 0 || res === undefined
                    ? null
                    : createTT({
                          loading: this.loading,
                          info: info,
                          res: res,
                      })}
                <div ref={this.arrRef} className={tooSty.arrow} {...TT_ARR} />
            </div>
        );
    }
}

ToolTipInfoVD.contextType = MainConGl;

export default ToolTipInfoVD;
