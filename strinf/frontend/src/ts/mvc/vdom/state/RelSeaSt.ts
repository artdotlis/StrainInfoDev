import Known500Error from '@strinf/ts/errors/known/500';
import type { SeaRelStInt, TabF, TabSetF } from '@strinf/ts/interfaces/dom/sea_rel';

class RelSeaSt implements SeaRelStInt {
    private tabH?: TabF;

    public get tab(): TabF {
        if (this.tabH === undefined) {
            throw new Known500Error('tab setter was not initialized');
        }
        return this.tabH;
    }

    public get tabSet(): TabSetF {
        return (setter: TabF): void => {
            this.tabH = setter;
        };
    }
}

export default RelSeaSt;
