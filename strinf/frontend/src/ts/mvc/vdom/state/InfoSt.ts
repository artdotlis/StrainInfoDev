import type { InfoR, InfoS } from '@strinf/ts/interfaces/api/mapped';
import type { InfF, InfoStInt, InfSetF } from '@strinf/ts/interfaces/dom/tooltip';
import Known500Error from '@strinf/ts/errors/known/500';

class InfoSt<I extends InfoS | InfoR> implements InfoStInt<I> {
    private resH?: InfF<I>;

    public get res(): InfF<I> {
        if (this.resH === undefined) {
            throw new Known500Error('res setter was not initialized');
        }
        return this.resH;
    }

    public get resSet(): InfSetF<I> {
        return (setter: InfF<I>): void => {
            this.resH = setter;
        };
    }
}

export default InfoSt;
