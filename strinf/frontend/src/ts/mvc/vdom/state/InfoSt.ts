import Known500Error from '@strinf/ts/errors/known/500';
import type { InfF, InfoStInt, InfSetF } from '@strinf/ts/interfaces/dom/tooltip';

class InfoSt implements InfoStInt {
    private resH?: InfF;

    public get res(): InfF {
        if (this.resH === undefined) {
            throw new Known500Error('res setter was not initialized');
        }
        return this.resH;
    }

    public get resSet(): InfSetF {
        return (setter: InfF): void => {
            this.resH = setter;
        };
    }
}

export default InfoSt;
