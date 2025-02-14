import { unFocus } from '@strinf/ts/functions/http/sea';

function defaultRouteBeh(): void {
    unFocus();
    const anchor = window.location.hash;
    if (anchor === '') {
        window.scroll({ top: 0, left: 0, behavior: 'instant' });
    } else {
        window.location.hash = anchor;
    }
}

export default defaultRouteBeh;
