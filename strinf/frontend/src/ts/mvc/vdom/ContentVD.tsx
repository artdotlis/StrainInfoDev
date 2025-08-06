import { Router, Route, lazy, useLocation } from 'preact-iso';
import { useContext, useEffect, useRef } from 'preact/hooks';
import { UIApiCon } from '@strinf/ts/constants/api/ui_api';
import type { BreadCrumbsG } from '@strinf/ts/interfaces/dom/global';
import { trackPageV } from '@strinf/ts/mvc/vdom/fun/mat/track';
import defaultRouteBeh from '@strinf/ts/mvc/vdom/fun/route/default';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import Redirect from '@strinf/ts/mvc/vdom/fun/route/Redirect';
import type { JSX } from 'preact';
import { ClHtml, Dis, Pad } from '@strinf/ts/constants/style/ClHtml';
import FootVD from '@strinf/ts/mvc/vdom/FootVD';
import { LID } from '@strinf/ts/mvc/vdom/static/misc/LoadVD';

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

function SeaWrVD({
    sea_typ,
    sea_val,
}: {
    sea_typ?: string;
    sea_val?: string;
}): JSX.Element {
    const location = useLocation();
    return <SEA_VD location={location} typ={sea_typ} val={sea_val} />;
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
const PATH_SEARCH = `${UIApiCon.search}/:sea_typ/:sea_val`;

const PATH_PRE = [UIApiCon.strain, UIApiCon.search, UIApiCon.pass] as const;

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

function disableLoader(): void {
    // TODO not an optimal solution
    const load = document.querySelector(`#${LID}`);
    if (load !== null) {
        load.remove();
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
    let errorP = '';
    useEffect(() => {
        if (error()) {
            conR.current?.classList.add(Dis.dNone);
            errR.current?.classList.remove(Dis.dNone);
            errorP = window.location.pathname + window.location.search;
            disable();
            disableLoader();
        } else {
            conR.current?.classList.remove(Dis.dNone);
            errR.current?.classList.add(Dis.dNone);
        }
    }, [error]);
    if (ctx === undefined) {
        return null;
    }
    if (panic) {
        return (
            <div className={ClHtml.cntWr}>
                <div className={ClHtml.cntCon}>
                    <PANIC_VD />
                </div>
                <FootVD />
            </div>
        );
    }
    return (
        <div className={ClHtml.cntWr}>
            <div
                className={`${ClHtml.cntCon} ${Pad.bN0}`}
                ref={errR}
                style={{
                    minHeight: '100vh',
                }}
            >
                <ERROR_VD />
            </div>
            <div
                className={`${ClHtml.cntCon} ${Pad.bN0}`}
                ref={conR}
                style={{
                    minHeight: '100vh',
                }}
            >
                <Router
                    onRouteChange={(path) => {
                        if (errorP !== path) {
                            errorP = '';
                        }
                        if (errorP === '') {
                            conR.current?.classList.remove(Dis.dNone);
                            errR.current?.classList.add(Dis.dNone);
                            onRouteChange(path);
                        }
                    }}
                >
                    <Route path={UIApiCon.index} component={INDEX_VD} />
                    <Route
                        path={UIApiCon.indexFull}
                        to={UIApiCon.index}
                        component={Redirect}
                    />
                    <Route path={PATH_SEARCH} component={SeaWrVD} />
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
            </div>
            <FootVD />
        </div>
    );
}

export default ContentVD;
