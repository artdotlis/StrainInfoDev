import type { ServerStatusJT } from '@strinf/ts/interfaces/api/data';
import { checkRespObjOk, createUrlStr, fetchRetry } from '@strinf/ts/functions/http/http';
import { isServerStatus } from '@strinf/ts/functions/api/map';
import CONFIG from '@strinf/ts/configs/config';

const CACHE: {
    time: number;
    status?: ServerStatusJT;
} = {
    time: 0,
};

function fetchStatus(
    callback: (json: ServerStatusJT) => void,
    panic: () => void,
    fetchInit?: RequestInit
) {
    fetchRetry(createUrlStr(CONFIG.backend, '/'), fetchInit, 2)
        .then(async (resp) => checkRespObjOk<ServerStatusJT>(resp, isServerStatus))
        .then((results: ServerStatusJT): void => {
            CACHE.time = new Date().getTime();
            CACHE.status = results;
            callback(results);
        })
        .catch(panic);
}

function getServerStatus(
    callback: (json: ServerStatusJT) => void,
    panic: () => void,
    fetchInit?: RequestInit
): void {
    const [timeCur, timeLast] = [new Date().getTime(), CACHE.time];
    if ((timeCur - timeLast) / 1000 > 10 || CACHE.status === undefined) {
        fetchStatus(callback, panic, fetchInit);
    } else {
        callback(CACHE.status);
    }
}

export default getServerStatus;
