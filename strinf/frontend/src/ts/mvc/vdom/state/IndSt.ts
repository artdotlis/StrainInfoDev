import Known500Error from '@strinf/ts/errors/known/500';
import type { DiaF, DiaSetF } from '@strinf/ts/interfaces/dom/dia';
import type { IndStInt, StaF, StaSetF } from '@strinf/ts/interfaces/dom/ind';

class IndSt implements IndStInt {
    private staH?: StaF;

    private diaH?: DiaF;

    public get stat(): StaF {
        if (this.staH === undefined) {
            throw new Known500Error('stat setter was not initialized');
        }
        return this.staH;
    }

    public get conf(): DiaF {
        if (this.diaH === undefined) {
            throw new Known500Error('conf setter was not initialized');
        }
        return this.diaH;
    }

    public get confSet(): DiaSetF {
        return (setter: DiaF): void => {
            this.diaH = setter;
        };
    }

    public get statSet(): StaSetF {
        return (setter: StaF): void => {
            this.staH = setter;
        };
    }
}

export default IndSt;
