import { Helmet } from 'react-helmet';
import { UIApiCon } from '@strinf/ts/constants/api/ui_api';
import type { JSX } from 'preact';

const bgI1920 = new URL('@assets/bg/main_1920.webp', import.meta.url).href;
const bgI1280 = new URL('@assets/bg/main_1280.webp', import.meta.url).href;
const bgI800 = new URL('@assets/bg/main_800.webp', import.meta.url).href;
const bgI400 = new URL('@assets/bg/main_400.webp', import.meta.url).href;

function selectBannerImage(): string {
    const width = document.body.clientWidth;
    if (width > 1280) {
        return bgI1920;
    }
    if (width > 800) {
        return bgI1280;
    }
    if (width > 400) {
        return bgI800;
    }
    return bgI400;
}

const BANNER_URL = [
    String(UIApiCon.index),
    String(UIApiCon.search),
    String(UIApiCon.pass),
] as const;

function createPreloadBanner(): JSX.Element {
    if (BANNER_URL.includes(window.location.pathname)) {
        return (
            <Helmet>
                <link
                    rel="preload"
                    as="image"
                    href={selectBannerImage()}
                    type="image/webp"
                />
            </Helmet>
        );
    }
    return <></>;
}

export { selectBannerImage, createPreloadBanner };
