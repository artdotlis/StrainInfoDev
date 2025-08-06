import { Router, Route, lazy, useLocation } from 'preact-iso';
import type { MutableRef} from 'preact/hooks';
import { useContext, useEffect, useRef } from 'preact/hooks';
import { UIApiCon } from '@strinf/ts/constants/api/ui_api';
import type { BreadCrumbsG, ErrStCon } from '@strinf/ts/interfaces/dom/global';
import { trackPageV } from '@strinf/ts/mvc/vdom/fun/mat/track';
import defaultRouteBeh from '@strinf/ts/mvc/vdom/fun/route/default';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import Redirect from '@strinf/ts/mvc/vdom/fun/route/Redirect';
import type { JSX } from 'preact';
import { ClHtml, Dis, Pad } from '@strinf/ts/constants/style/ClHtml';
import FootVD from '@strinf/ts/mvc/vdom/FootVD';
import { LID } from '@strinf/ts/mvc/vdom/static/misc/LoadVD';
import ErrType from '@strinf/ts/constants/type/ErrT';

const INDEX_VD = lazy(async () => import('@strinf/ts/mvc/vdom/main/IndexVD'));
const CONTACT_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/ContactVD'));
const DOCS_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/DocsVD'));
const ERROR_VD = lazy(async () => import('@strinf/ts/mvc/vdom/ErrorVD'));
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

function crRoutesVD(blocked: MutableRef<boolean>): JSX.Element[] {
    if (blocked.current) {
        return [<Route key="default" default component={EMPTY_VD} />];
    }
    return [
        <Route key={UIApiCon.index} path={UIApiCon.index} component={INDEX_VD} />,
        <Route
            key={UIApiCon.indexFull}
            path={UIApiCon.indexFull}
            to={UIApiCon.index}
            component={Redirect}
        />,
        <Route key={PATH_SEARCH} path={PATH_SEARCH} component={SeaWrVD} />,
        <Route key={UIApiCon.search} path={UIApiCon.search} component={SeaWrVD} />,
        <Route key={UIApiCon.pass} path={UIApiCon.pass} component={SeaWrVD} />,
        <Route key={PATH_STRAIN} path={PATH_STRAIN} component={PassWrVD} />,
        <Route key={UIApiCon.about} path={UIApiCon.about} component={ABOUT_PVD} />,
        <Route key={UIApiCon.contact} path={UIApiCon.contact} component={CONTACT_VD} />,
        <Route key={UIApiCon.team} path={UIApiCon.team} component={TEAM_VD} />,
        <Route key={UIApiCon.strReg} path={UIApiCon.strReg} component={STR_REG_VD} />,
        <Route key={UIApiCon.news} path={UIApiCon.news} component={NEWS_VD} />,
        <Route key={UIApiCon.manual} path={UIApiCon.manual} component={DOCS_VD} />,
        <Route key={UIApiCon.imprint} path={UIApiCon.imprint} component={IMP_VD} />,
        <Route key={UIApiCon.service} path={UIApiCon.service} component={API_VD} />,
        <Route key="default" default component={EMPTY_VD} />,
    ];
}

function ContentVD({
    panic,
    error,
    disable,
}: {
    panic: boolean;
} & ERR_PROP): JSX.Element | null {
    const ctx: (BreadCrumbsG & ErrStCon) | undefined = useContext(MainConGl);
    const errR = useRef<HTMLDivElement>(null);
    const conR = useRef<HTMLDivElement>(null);
    const errorP = useRef<string>('');
    const errorB = useRef<boolean>(false);
    if (error() && errorP.current === '') {
        errorP.current = window.location.pathname + window.location.search;
    }
    if (panic || ctx?.errT === ErrType.E503) {
        errorB.current = true;
    }
    useEffect(() => {
        if (error() && errorP.current === '') {
            disable();
            disableLoader();
        }
    }, [error, panic]);
    if (ctx === undefined) {
        return null;
    }
    return (
        <div className={ClHtml.cntWr}>
            <div
                className={`${ClHtml.cntCon} ${Pad.bN0}
                ${errorP.current === '' ? Dis.dNone : ''}`}
                style={{ minHeight: '100vh' }}
                ref={errR}
            >
                <ERROR_VD blocked={errorB} />
            </div>
            <div
                className={`${ClHtml.cntCon} ${Pad.bN0}
                ${errorP.current !== '' ? Dis.dNone : ''}`}
                style={{ minHeight: '100vh' }}
                ref={conR}
            >
                <Router
                    onRouteChange={(path) => {
                        if (errorP.current !== path && !errorB.current) {
                            errorP.current = '';
                            onRouteChange(path);
                            conR.current?.classList.remove(Dis.dNone);
                            errR.current?.classList.add(Dis.dNone);
                        }
                    }}
                >
                    {crRoutesVD(errorB)}
                </Router>
            </div>
            <FootVD />
        </div>
    );
}

export default ContentVD;
