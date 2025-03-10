import { Router, Route, lazy, useLocation } from 'preact-iso';
import { useContext, useRef } from 'preact/hooks';
import { memo } from 'preact/compat';
import { UIApiCon } from '@strinf/ts/constants/api/ui_api';
import type { BreadCrumbsG } from '@strinf/ts/interfaces/dom/global';
import { trackPageV } from '@strinf/ts/mvc/vdom/fun/mat/track';
import defaultRouteBeh from '@strinf/ts/mvc/vdom/fun/route/default';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import Redirect from '@strinf/ts/mvc/vdom/fun/route/Redirect';
import type { JSX } from 'preact';
import { ClHtml, Dis } from '@strinf/ts/constants/style/ClHtml';
import FootVD from '@strinf/ts/mvc/vdom/FootVD';

const INDEX_VD = lazy(async () => import('@strinf/ts/mvc/vdom/main/IndexVD'));
const CONTACT_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/ContactVD'));
const DOCS_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/DocsVD'));
const ERROR_VD = lazy(async () => import('@strinf/ts/mvc/vdom/ErrorVD'));
const PANIC_VD = lazy(async () => import('@strinf/ts/mvc/vdom/PanicVD'));
const SEA_VD = lazy(async () => import('@strinf/ts/mvc/vdom/main/SearchVD'));

interface ERR_PROP {
    error: () => boolean;
    disable: () => void;
}

function SeaWrVD(): JSX.Element {
    const location = useLocation();
    return <SEA_VD location={location} />;
}

const PASS_VD = lazy(async () => import('@strinf/ts/mvc/vdom/main/PassVD'));

function PassWrVD({ id }: { id: string }): JSX.Element {
    const location = useLocation();
    return <PASS_VD location={location} id={id} />;
}

const ABOUT_PVD = lazy(async () => import('@strinf/ts/mvc/vdom/static/AboutMainVD'));
const TEAM_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/TeamVD'));
const STR_REG_VD = lazy(
    async () => import('@strinf/ts/mvc/vdom/static/StrainRegistryVD')
);
const NEWS_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/NewsVD'));
const IMP_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/ImprintVD'));
const EMPTY_VD = lazy(async () => import('@strinf/ts/mvc/vdom/EmptyVD'));
const API_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/ApiVd'));

const PATH_STRAIN = `${UIApiCon.strain}:id`;

const PATH_PRE = [
    UIApiCon.strain.toString(),
    UIApiCon.search.toString(),
    UIApiCon.pass.toString(),
] as const;

function onRouteChange(path: string): void {
    defaultRouteBeh();
    let track = true;
    for (const ign of PATH_PRE) {
        if (path.startsWith(ign)) {
            track = false;
            break;
        }
    }
    if (track) {
        trackPageV();
    }
}

function ContentVD({
    panic,
    error,
    disable,
}: {
    panic: boolean;
} & ERR_PROP): JSX.Element | null {
    const ctx: BreadCrumbsG | undefined = useContext(MainConGl);
    const errR = useRef<HTMLDivElement>(null);
    const conR = useRef<HTMLDivElement>(null);
    if (ctx === undefined) {
        return null;
    }
    if (panic) {
        return <PANIC_VD />;
    }
    const clE = error() ? '' : Dis.dNone;
    const clC = error() ? Dis.dNone : '';
    return (
        <>
            <div className={`${ClHtml.cntWr} ${clE}`} ref={errR}>
                <div className={ClHtml.cntCon}>
                    <ERROR_VD />
                </div>
                <FootVD />
            </div>
            <div className={`${ClHtml.cntWr} ${clC}`} ref={conR}>
                <Router
                    onRouteChange={(path) => {
                        if (!error()) {
                            onRouteChange(path);
                        }
                    }}
                    onLoadEnd={() => {
                        if (
                            error() &&
                            (conR.current?.classList.contains(Dis.dNone) ?? false)
                        ) {
                            conR.current?.classList.remove(Dis.dNone);
                            errR.current?.classList.add(Dis.dNone);
                            disable();
                        }
                    }}
                >
                    <Route path={UIApiCon.index} component={INDEX_VD} />
                    <Route
                        path={UIApiCon.indexFull}
                        to={UIApiCon.index}
                        component={Redirect}
                    />
                    <Route path={UIApiCon.search} component={SeaWrVD} />
                    <Route path={UIApiCon.pass} component={SeaWrVD} />
                    <Route path={PATH_STRAIN} component={PassWrVD} />
                    <Route path={UIApiCon.about} component={ABOUT_PVD} />
                    <Route path={UIApiCon.contact} component={CONTACT_VD} />
                    <Route path={UIApiCon.team} component={TEAM_VD} />
                    <Route path={UIApiCon.strReg} component={STR_REG_VD} />
                    <Route path={UIApiCon.news} component={NEWS_VD} />
                    <Route path={UIApiCon.manual} component={DOCS_VD} />
                    <Route path={UIApiCon.imprint} component={IMP_VD} />
                    <Route path={UIApiCon.service} component={API_VD} />
                    <Route default component={EMPTY_VD} />
                </Router>
                <FootVD />
            </div>
        </>
    );
}

export default memo(ContentVD);
