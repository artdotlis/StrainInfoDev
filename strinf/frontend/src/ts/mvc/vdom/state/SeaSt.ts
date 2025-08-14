import type { LoadFS } from '@strinf/ts/interfaces/dom/global';
import type { ProgF, ProgSetF } from '@strinf/ts/interfaces/dom/prog';
import type {
    SeaStInt,
    TabF,
    TabSetF,
    ToPassF,
    ToPassSetF,
} from '@strinf/ts/interfaces/dom/sea';
import Known500Error from '@strinf/ts/errors/known/500';

class SeaSt implements SeaStInt {
    private progH?: ProgF;

    private tabH?: TabF;

    private toPassH?: ToPassF;

    private loadSeaH: () => LoadFS[];

    constructor() {
        this.loadSeaH = () => [];
    }

    public get load(): LoadFS[] {
        return this.loadSeaH();
    }

    public setLoad(load: () => LoadFS[]): void {
        this.loadSeaH = load;
    }

    public get tab(): TabF {
        if (this.tabH === undefined) {
            throw new Known500Error('tab setter was not initialized');
        }
        return this.tabH;
    }

    public get toPass(): ToPassF {
        if (this.toPassH === undefined) {
            throw new Known500Error('toPass setter was not initialized');
        }
        return this.toPassH;
    }

    public get prog(): ProgF {
        if (this.progH === undefined) {
            throw new Known500Error('prog setter was not initialized');
        }
        return this.progH;
    }

    public get progSet(): ProgSetF {
        return (setter: ProgF): void => {
            this.progH = setter;
        };
    }

    public get tabSet(): TabSetF {
        return (setter: TabF): void => {
            this.tabH = setter;
        };
    }

    public get toPassSet(): ToPassSetF {
        return (setter: ToPassF): void => {
            this.toPassH = setter;
        };
    }
}

export default SeaSt;
