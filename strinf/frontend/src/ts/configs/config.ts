import checkConfCon from '@strinf/ts/functions/types/configs';

function evaluatedEnv(): boolean {
    const prod: unknown = import.meta.env.PROD;
    if ('VITE_STAGE' in import.meta.env) {
        return false;
    }
    if (typeof prod === 'string' || prod instanceof String) {
        return /^TRUE$/.test(String(prod).toUpperCase());
    }
    return Boolean(prod);
}

const CONFIG = Object.freeze(
    checkConfCon({
        production: evaluatedEnv(),
        stage: 'VITE_STAGE' in import.meta.env,
        index: {
            key_len: Number(import.meta.env.VITE_FEC_KEY_LEN),
        },
        backend: {
            domain: String(import.meta.env.VITE_FEC_BE_DOMAIN),
            protocol: String(import.meta.env.VITE_FEC_BE_PROTOCOL),
            port: Number(import.meta.env.VITE_FEC_BE_PORT),
        },
        frontend: {
            domain: String(import.meta.env.VITE_FEC_FE_DOMAIN),
            protocol: String(import.meta.env.VITE_FEC_FE_PROTOCOL),
            port: Number(import.meta.env.VITE_FEC_FE_PORT),
        },
        statistic: {
            enable: /^TRUE$/.test(
                String(import.meta.env.VITE_FEC_ST_ENABLE ?? false).toUpperCase()
            ),
            id: Number(import.meta.env.VITE_FEC_ST_ID),
            matomo: {
                domain: String(import.meta.env.VITE_FEC_ST_PW_DOMAIN),
                protocol: String(import.meta.env.VITE_FEC_ST_PW_PROTOCOL),
                port: Number(import.meta.env.VITE_FEC_ST_PW_PORT),
            },
            domain: String(import.meta.env.VITE_FEC_ST_DOMAIN).split(','),
        },
    })
);
export default CONFIG;
