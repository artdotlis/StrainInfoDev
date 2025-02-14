import createSeaCall from '@strinf/ts/functions/links/create_sea';
import { routeUri } from '@strinf/ts/functions/http/http';

function unFocus(): void {
    const act = document.activeElement;
    if (act instanceof HTMLElement) {
        act.blur();
    }
}
function callSearch(resIn: string | number | string[]): void {
    routeUri(createSeaCall(resIn), '');
}

export { callSearch, unFocus };
