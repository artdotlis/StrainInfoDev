import type { RouterOnChangeArgs } from 'preact-router';
import Router from 'preact-router';
import { useContext } from 'preact/hooks';
import { UIApiCon } from '@strinf/ts/constants/api/ui_api';
import type { BreadCrumbsG } from '@strinf/ts/interfaces/dom/global';
import { trackPageV } from '@strinf/ts/mvc/vdom/fun/mat/track';
import defaultRouteBeh from '@strinf/ts/mvc/vdom/fun/route/default';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import Redirect from '@strinf/ts/mvc/vdom/fun/route/Redirect';
import { Suspense, lazy } from 'preact/compat';
import { crEmptyContCon } from '@strinf/ts/mvc/vdom/fun/content/content';
import type { JSX } from 'preact';

const INDEX_VD = lazy(async () => import('@strinf/ts/mvc/vdom/main/IndexVD'));
const CONTACT_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/ContactVD'));
const DOCS_VD = lazy(async () => import('@strinf/ts/mvc/vdom/static/DocsVD'));
const ERROR_VD = lazy(async () => import('@strinf/ts/mvc/vdom/ErrorVD'));
const PANIC_VD = lazy(async () => import('@strinf/ts/mvc/vdom/PanicVD'));
const SEA_VD = lazy(async () => import('@strinf/ts/mvc/vdom/main/SearchVD'));
const PASS_VD = lazy(async () => import('@strinf/ts/mvc/vdom/main/PassVD'));
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

function onRouteChange(path: string): void {
    defaultRouteBeh();
    if (
        ![
            PATH_STRAIN,
            UIApiCon.pass.toString(),
            UIApiCon.search.toString(),
            UIApiCon.error.toString(),
        ].includes(path)
    ) {
        trackPageV();
    }
}

const ROUTES: (() => JSX.Element)[] = [
    () => <ERROR_VD path={UIApiCon.error} />,
    () => <INDEX_VD path={UIApiCon.index} />,
    () => <Redirect path={UIApiCon.indexFull} to={UIApiCon.index} />,
    () => <SEA_VD path={UIApiCon.search} />,
    () => <SEA_VD path={UIApiCon.pass} />,
    () => <PASS_VD path={PATH_STRAIN} />,
    () => <ABOUT_PVD path={UIApiCon.about} />,
    () => <CONTACT_VD path={UIApiCon.contact} />,
    () => <TEAM_VD path={UIApiCon.team} />,
    () => <STR_REG_VD path={UIApiCon.strReg} />,
    () => <NEWS_VD path={UIApiCon.news} />,
    () => <DOCS_VD path={UIApiCon.manual} />,
    () => <IMP_VD path={UIApiCon.imprint} />,
    () => <API_VD path={UIApiCon.service} />,
    () => <EMPTY_VD path="/:path*" />,
];

function ContentVD({ panic }: { panic: boolean }): JSX.Element | null {
    const ctx: BreadCrumbsG | undefined = useContext(MainConGl);
    let routes = ROUTES;
    if (ctx === undefined) {
        return null;
    }
    return (
        <Suspense fallback={crEmptyContCon()}>
            <Router
                onChange={(args: RouterOnChangeArgs) => {
                    if (!panic) {
                        onRouteChange(args.path ?? '');
                    }
                }}
            >
                {panic ? <PANIC_VD path="/:path*" /> : routes.map((ele) => ele())}
            </Router>
        </Suspense>
    );
}

export default ContentVD;
