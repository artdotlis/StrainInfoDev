import type { JSX, RefObject } from 'preact';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import type { GlobVersionGet, LoadSet } from '@strinf/ts/interfaces/dom/global';
import type { InValInt } from '@strinf/ts/interfaces/dom/inp';
import type PagPosT from '@strinf/ts/constants/type/PagPosT';
import { ERR_MARK } from '@strinf/ts/constants/type/ErrT';
import markErr from '@strinf/ts/mvc/vdom/fun/sea/input';
import InputVD from '@strinf/ts/mvc/vdom/main/input/InputVD';
import { Component, createRef } from 'preact';

interface SeaInProps {
    len: string;
    pos: PagPosT;
    tId?: string;
}

interface SeaInState {
    inVal: string;
}

class SeaInVD extends Component<SeaInProps, SeaInState> {
    private readonly inR: RefObject<HTMLInputElement>;

    constructor(props: SeaInProps) {
        super(props);
        this.state = { inVal: '' };
        this.inR = createRef<HTMLInputElement>();
    }

    public render(): JSX.Element | null {
        const ctx: (GlobVersionGet & LoadSet & InValInt) | undefined = this.context;
        const { len, pos, tId } = this.props;
        const { inVal } = this.state;
        if (ctx === undefined) {
            return null;
        }
        this.updateInVal(ctx, pos);
        return (
            <InputVD
                callB={() => this.inR}
                upD={() => {
                    const cuInVal = this.inR.current?.value ?? '';
                    ctx.inVal.map((eleF) => {
                        eleF(cuInVal);
                    });
                }}
                val={inVal.length > 0 ? inVal : ctx.inValCur}
                len={len}
                tId={tId}
                ctx={ctx}
            />
        );
    }

    private updateInVal(ctx: InValInt, id: string): void {
        ctx.inValSet(id)((val: string) => {
            let valOut = val;
            if (val === ERR_MARK) {
                valOut = '';
                markErr(this.inR.current);
            }
            ctx.setInValCur(valOut);
            this.setState({ inVal: valOut });
        });
    }
}
SeaInVD.defaultProps = {
    tId: undefined,
};
SeaInVD.contextType = MainConGl;

export default SeaInVD;
