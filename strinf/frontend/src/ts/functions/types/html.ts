import { hasProp } from '@strinf/ts/functions/types/arr';

function getFormSelValue(key: string, formEl: object): string {
    if (hasProp(key, formEl)) {
        const conV = formEl[key];
        if (conV instanceof HTMLSelectElement) {
            return conV.value;
        }
    }
    return '';
}

function getFormInputCheckValue(key: string, formEl: object): string {
    if (hasProp(key, formEl)) {
        const conV = formEl[key];
        if (conV instanceof HTMLInputElement) {
            return conV.checked ? conV.value : '';
        }
    }
    return '';
}

export { getFormSelValue, getFormInputCheckValue };
