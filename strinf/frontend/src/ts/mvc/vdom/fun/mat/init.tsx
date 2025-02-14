import type { StatsT } from '@strinf/ts/interfaces/misc/configs';
import { Helmet } from 'react-helmet';
import type { JSX } from 'preact';

function initF(url: string, id: string): JSX.Element {
    window._paq = window._paq ?? [];
    window._paq.push(['setTrackerUrl', `${url}matomo.php`]);
    window._paq.push(['setSiteId', id]);
    return (
        <Helmet>
            <script type="text/javascript" src={`${url}matomo.js`} />
        </Helmet>
    );
}

function initT(domains: string[]): void {
    window._paq = window._paq ?? [];
    window._paq.push(['setDomains', domains]);
    window._paq.push(['setDoNotTrack', true]);
    window._paq.push(['disableCookies']);
    window._paq.push(['enableLinkTracking']);
}

function createUrl(mat: StatsT): string {
    let matPort = `:${mat.matomo.port}`;
    if (
        (mat.matomo.protocol === 'https' && mat.matomo.port === 443) ||
        (mat.matomo.protocol === 'http' && mat.matomo.port === 80)
    ) {
        matPort = '';
    }
    return `${mat.matomo.protocol}://${mat.matomo.domain}${matPort}/`;
}

function initMat(mat: StatsT): JSX.Element | null {
    if (mat.enable && window.matomoLoaded === undefined) {
        window._paq = window._paq ?? [];
        initT(mat.domain);
        const matomo = initF(createUrl(mat), `${mat.id}`);
        window.matomoLoaded = true;
        return matomo;
    }
    return null;
}

function setMatomoInterval(callback: () => void, onfail: () => void): void {
    let cnt = 0;
    const interval = setInterval(() => {
        switch (true) {
            case typeof window.Matomo === 'object':
                clearInterval(interval);
                callback();
                break;
            case window.matomoLoaded === false || cnt > 3:
                clearInterval(interval);
                onfail();
                break;
            default:
                cnt += 1;
        }
    }, 300);
}

function matomoCallback(callback: () => void): void {
    if (window.matomoLoaded === true) {
        callback();
    } else if (window.matomoLoaded !== false) {
        setMatomoInterval(callback, () => {
            console.log('matomo not loaded');
        });
    }
}

export default initMat;
export { matomoCallback };
