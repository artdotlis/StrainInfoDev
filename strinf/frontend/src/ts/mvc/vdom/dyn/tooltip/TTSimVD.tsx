// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { TTHookS } from '@strinf/ts/interfaces/dom/global';
import type { ToolTipHookInt, TT_GL_TYPE } from '@strinf/ts/interfaces/dom/tooltip';
import type { JSX, RefObject } from 'preact';
import tooSty from '@strinf/css/mods/tooltip.module.css';
import { HIDE_ATTR, TT_ARR, TT_SRC } from '@strinf/ts/constants/style/AtHtml';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import Known500Error from '@strinf/ts/errors/known/500';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import ToolTipHook from '@strinf/ts/mvc/vdom/state/InfoHk';
import { createRef, isValidElement } from 'preact';
import { memo, PureComponent } from 'preact/compat';

interface ToolState {
    changes: boolean;
}

interface ToolTipProps {
    data: JSX.Element | undefined;
}

function crToolTipC(res: JSX.Element): JSX.Element {
    return (
        <div className={ClHtml.con}>
            <div className={ClHtml.cnt}>{res}</div>
        </div>
    );
}

function ToolTipC({ data }: ToolTipProps): JSX.Element {
    if (data === undefined) {
        return crToolTipC(<div key={0}>Loading ...</div>);
    }
    return crToolTipC(data);
}

const ToolTipCM = memo(ToolTipC);

const TT_ID_SIM = 'tooltip_simple_id';

class TTSimVD extends PureComponent<object, ToolState> {
    private readonly tooRef: RefObject<HTMLDivElement>;

    private readonly arrRef: RefObject<HTMLDivElement>;

    private vNode?: JSX.Element;

    private readonly hook: ToolTipHookInt<TT_GL_TYPE>;

    constructor(props: object) {
        super(props);
        this.state = { changes: false };
        this.tooRef = createRef<HTMLDivElement>();
        this.arrRef = createRef<HTMLDivElement>();
        this.hook = new ToolTipHook();
    }

    public initTT(): void {
        const ctx: TTHookS<TT_GL_TYPE> | undefined = this.context;
        ctx?.ttHookSet(TT_ID_SIM)(this.hook);
        this.hook.dataSetter((datCon: TT_GL_TYPE) => {
            if (!isValidElement(datCon)) {
                throw new Known500Error('simple tooltip expected react element');
            }
            this.vNode = datCon;
            const { changes } = this.state;
            this.setState({ changes: !changes });
        });
        this.hook.setTTSrc([this.tooRef, this.arrRef]);
    }

    public render(): JSX.Element {
        this.initTT();
        return (
            <div ref={this.tooRef} className={tooSty.tooltip} {...HIDE_ATTR} {...TT_SRC}>
                <ToolTipCM data={this.vNode} />
                <div ref={this.arrRef} className={tooSty.arrow} {...TT_ARR} />
            </div>
        );
    }
}

TTSimVD.contextType = MainConGl;
export default TTSimVD;
export { TT_ID_SIM };
