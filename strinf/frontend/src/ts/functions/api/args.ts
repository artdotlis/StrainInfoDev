import QApiCon from '@strinf/ts/constants/api/q_api';

function getArgs(regex: RegExp, uri = ''): string {
    let cUri = uri;
    if (uri === '') {
        cUri = decodeURI(window.location.search);
    }
    const nre = new RegExp(regex);
    nre.lastIndex = 0;
    const res = nre.exec(cUri);
    if (res !== null && res.length === 2) {
        return res[1] ?? '';
    }
    return '';
}

function isOnlyOneStr(api: string, args: string): boolean {
    if (QApiCon.seaCulStrId === api) {
        const idSet = new Set();
        for (const strid of decodeURIComponent(args).split(',')) {
            idSet.add(strid.trim());
        }
        return idSet.size === 1;
    }
    return false;
}

export { isOnlyOneStr, getArgs };
