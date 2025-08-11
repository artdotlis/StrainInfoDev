import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import { SEARCH_FILTER_CL } from '@strinf/ts/mvc/vdom/dyn/search/SeaTVD';

function getInputSearch(): string {
    return `.${SEARCH_FILTER_CL} button`;
}

function getSortSearch(): string {
    return `.${ClHtml.cntCon} thead i`;
}

export { getInputSearch, getSortSearch };
