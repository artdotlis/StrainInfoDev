import type { InValFS, InValStInt } from '@strinf/ts/interfaces/dom/inp';

function updateHrefVal<T extends string | number>(
    search: T | T[],
    ctx: InValStInt | undefined
): void {
    const nVal = search instanceof Array ? (search[0] ?? 'unknown') : search;
    (ctx?.inVal ?? ([] as InValFS[])).map((eleF) => {
        eleF(`${nVal}`);
    });
}

export default updateHrefVal;
