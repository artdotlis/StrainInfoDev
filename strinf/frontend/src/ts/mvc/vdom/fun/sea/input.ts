import QApiCon from '@strinf/ts/constants/api/q_api';
import IdAcrTagCon from '@strinf/ts/constants/acr/id_acr';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';

function markErr(inF: HTMLInputElement | null): void {
    if (inF !== null) {
        inF.classList.add(ClHtml.inv);
        setTimeout(() => {
            inF.classList.remove(ClHtml.inv);
        }, 5000);
    }
}

function addTagToInput(value: string, api: string): string {
    if (
        [
            String(QApiCon.seaCulStrId),
            String(QApiCon.strMin),
            String(QApiCon.strAvg),
            String(QApiCon.strMax),
        ].includes(api)
    ) {
        return `${IdAcrTagCon.strId} ${value}`;
    }
    if (
        [String(QApiCon.culMin), String(QApiCon.culAvg), String(QApiCon.culMax)].includes(
            api
        )
    ) {
        return `${IdAcrTagCon.strId} ${value}`;
    }
    return value;
}

export default markErr;
export { addTagToInput };
