import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import { SEARCH_TABLE_IN_CL } from '@strinf/ts/mvc/vdom/dyn/table/Table';

function getInputSearch(): string {
    return `.${SEARCH_TABLE_IN_CL} input`;
}

function getSortSearch(): string {
    return `.${ClHtml.cntCon} thead i`;
}

export { getInputSearch, getSortSearch };
