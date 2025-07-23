// critical style
import 'digidive/css/digidive.css';
import '@strinf/css/root.css';
// non critical style
import 'digidive/css/d3icons/style.css';
import '@phosphor-icons/web/regular';
import '@strinf/css/adhoc/anchor.css';

// style functionality
import 'digidive';

import { render } from 'preact';

import MainVD from '@strinf/ts/mvc/vdom/MainVD';
import { createUrlStr, hidePrivateInfo } from '@strinf/ts/functions/http/http';
import { createPreloadBanner } from '@strinf/ts/functions/files/image';
import CONFIG from '@strinf/ts/configs/config';
import type { JSX } from 'preact';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import { SIDE_SMALL } from '@strinf/ts/constants/style/AtHtml';
import { ErrorBoundary, LocationProvider } from 'preact-iso';

import loaderSty from '@strinf/css/mods/loader.module.css';
import PreConnectH from '@strinf/ts/mvc/vdom/static/helmet/ConnectH';

hidePrivateInfo();

function IndexBody(): JSX.Element {
    return (
        <body className={`${ClHtml.sideSM} ${loaderSty.loadoverlay}`} {...SIDE_SMALL}>
            <LocationProvider>
                <ErrorBoundary
                    onError={(err) => {
                        console.log('detected uncaught error', err.message);
                    }}
                >
                    <PreConnectH
                        id={'matomo_con'}
                        href={createUrlStr(CONFIG.statistic.matomo, '')}
                    />
                    <PreConnectH id={'api_con'} href={createUrlStr(CONFIG.backend, '')} />
                    {createPreloadBanner()}
                    <MainVD />
                </ErrorBoundary>
            </LocationProvider>
        </body>
    );
}

render(<IndexBody />, document.body.parentNode ?? document.body);
