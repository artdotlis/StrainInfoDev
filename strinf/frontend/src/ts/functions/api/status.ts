import type { ServerStatusJT } from '@strinf/ts/interfaces/api/data';
import { checkRespObjOk, createUrlStr, fetchRetry } from '@strinf/ts/functions/http/http';
import { isServerStatus } from '@strinf/ts/functions/api/map';
import Known500Error from '@strinf/ts/errors/known/500';
import CONFIG from '@strinf/ts/configs/config';

const CACHE: {
    time: number;
    status?: ServerStatusJT;
} = {
    time: 0,
};

function fetchStatus(
    callback: (json: ServerStatusJT) => void,
    onErr: (err: unknown) => void,
    panic: () => void,
    fetchInit?: RequestInit
) {
    fetchRetry(createUrlStr(CONFIG.backend, '/'), fetchInit)
        .then(async (resp) => checkRespObjOk<ServerStatusJT>(resp, isServerStatus))
        .then((results: ServerStatusJT): void => {
            CACHE.time = new Date().getTime();
            CACHE.status = results;
            callback(results);
        })
        .catch((err: unknown) => {
            let nErr = err;
            if (
                err instanceof Error &&
                ['TimeoutError', 'AbortError'].includes(err.name)
            ) {
                panic();
                nErr = new Known500Error('Server back-end is not reachable!');
            }
            onErr(nErr);
        });
}
function getServerStatus(
    callback: (json: ServerStatusJT) => void,
    onErr: (err: unknown) => void,
    panic: () => void,
    fetchInit?: RequestInit
): void {
    const [timeCur, timeLast] = [new Date().getTime(), CACHE.time];
    if ((timeCur - timeLast) / 1000 > 10 || CACHE.status === undefined) {
        fetchStatus(callback, onErr, panic, fetchInit);
    } else {
        callback(CACHE.status);
    }
}

export default getServerStatus;
