import {
    createStrainCall,
    createStrainCultureCall,
} from '@strinf/ts/functions/links/create_pass';
import { routeUri } from '@strinf/ts/functions/http/http';
import Known500Error from '@strinf/ts/errors/known/500';

function callPass(strain: string, culture: string, replace: string): void {
    if (strain === '') {
        throw new Known500Error(`empty strain detected ${strain}`);
    }
    const routeS =
        culture === ''
            ? createStrainCall(strain)
            : createStrainCultureCall(strain, culture);
    routeUri(routeS, replace);
}

export default callPass;
