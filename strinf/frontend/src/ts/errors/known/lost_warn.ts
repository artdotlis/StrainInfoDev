import ErrType from '@strinf/ts/constants/type/ErrT';
import KnownError from '@strinf/ts/errors/known/main';

class KnownLostWarnError extends KnownError {
    constructor(message: string) {
        super(message, ErrType.FEWARN);
        this.name = 'DATA FETCH WARNING';
    }
}

export default KnownLostWarnError;
