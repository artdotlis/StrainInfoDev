import Known500Error from '@strinf/ts/errors/known/500';
import onPrError from '@strinf/ts/functions/err/async';
import { fetchRetry } from '../http/http';

async function readTextFile(file: string): Promise<string> {
    const res = fetchRetry(file).then(async (results: Response): Promise<string> => {
        if (!results.ok) {
            const err = new Known500Error(`could not read file ${file}`);
            onPrError(err);
        }
        return results.text();
    });
    res.catch(onPrError);
    return res;
}

export default readTextFile;
