import ErrType from '@strinf/ts/constants/type/ErrT';
import KnownError from '@strinf/ts/errors/known/main';

class KnownInWarnError extends KnownError {
    constructor(message: string) {
        super(message, ErrType.INWARN);
        this.name = 'INPUT WARNING';
    }
}

export default KnownInWarnError;
