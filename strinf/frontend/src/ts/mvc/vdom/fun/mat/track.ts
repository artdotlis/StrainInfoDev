import { matomoCallback } from '@strinf/ts/mvc/vdom/fun/mat/init';

function trackPageV(): void {
    matomoCallback(() => {
        window._paq = window._paq ?? [];
        window._paq.push(['setCustomUrl', window.location.href]);
        window._paq.push(['trackPageView']);
    });
}

function trackPageRootV(time: number): void {
    matomoCallback(() => {
        window._paq = window._paq ?? [];
        const loc = window.location;
        const url = `${loc.protocol}//${loc.host}${loc.pathname}`;
        window._paq.push(['setCustomUrl', url]);
        window._paq.push(['setCustomVariable', 1, 'Response time', `${time}ms`, 'page']);
        window._paq.push(['trackPageView']);
    });
}

function trackSearch(
    seaC: string,
    seaV: string,
    cnt: number,
    paV: boolean,
    time: number
): void {
    if (paV) {
        trackPageRootV(time);
    }
    matomoCallback(() => {
        window._paq = window._paq ?? [];
        window._paq.push(['trackSiteSearch', `${seaC} - ${seaV}`, seaC, cnt]);
    });
}

function trackDownload(url: string, bytes: number): void {
    matomoCallback(() => {
        window._paq = window._paq ?? [];
        window._paq.push(['appendToTrackingUrl', `bw_bytes=${bytes}`]);
        window._paq.push(['trackLink', url, 'download']);
        window._paq.push(['appendToTrackingUrl', '']);
    });
}

export { trackPageV, trackSearch, trackDownload };
