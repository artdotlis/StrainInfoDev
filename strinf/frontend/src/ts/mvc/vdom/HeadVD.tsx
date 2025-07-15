import type { JSX } from 'preact';

import { ClHtml, Dis, Mar, Wid } from '@strinf/ts/constants/style/ClHtml';
import SeaInVD from '@strinf/ts/mvc/vdom/main/input/SeaInVD';
import FirInfVD from '@strinf/ts/mvc/vdom/static/misc/FirInfVD';
import PagPosT from '@strinf/ts/constants/type/PagPosT';
import AccVD from '@strinf/ts/mvc/vdom/static/misc/AccVd';
import MainNavVD from '@strinf/ts/mvc/vdom/dyn/misc/MainNavVD';
import IdHtmlTour from '@strinf/ts/constants/tour/IdHtml';
import LogoStrainInfoVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoStrainInfoVD';
import { useRef } from 'preact/hooks';
import SideNavVD from '@strinf/ts/mvc/vdom/dyn/misc/SideNavVD';
import { SIDE_ID, toggleSideBar } from '@strinf/ts/functions/libs/style';
import TTSimVD from '@strinf/ts/mvc/vdom/dyn/tooltip/TTSimVD';
import { createUrlStr } from '@strinf/ts/functions/http/http';
import HUB_L from '@strinf/ts/constants/links/hub_dsmz';
import LogoHubDsmzVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoHubDsmzVD';
import linkSty from '@strinf/css/mods/link.module.css';
import ToolTipInfoVD from '@strinf/ts/mvc/vdom/dyn/tooltip/TTInfoVD';
import { TT_ID_DEP, ToolTipDepCM } from '@strinf/ts/mvc/vdom/dyn/tooltip/TTDepVD';
import { ToolTipStrCM, TT_ID_STR } from '@strinf/ts/mvc/vdom/dyn/tooltip/TTStrVD';
import InfoCtrl from '@strinf/ts/mvc/ctrl/InfoCtrl';
import { toArrInfoDepRes, toArrInfoStrRes } from '@strinf/ts/functions/api/map';
import QApiCon from '@strinf/ts/constants/api/q_api';

function Logos(): JSX.Element {
    const dsmCl = `${ClHtml.navBbr} ${Mar.lNAT} ${Dis.dNone} ${Dis.dBS}`;
    return (
        <div className={ClHtml.con}>
            <a className={`${ClHtml.navBbr} ${ClHtml.posRel}`} href="/">
                <LogoStrainInfoVD />
            </a>
            <a
                className={dsmCl}
                href={createUrlStr(HUB_L, '')}
                target="_blank"
                rel="noopener"
            >
                <LogoHubDsmzVD height="90" full={true} />
            </a>
        </div>
    );
}

function NavBar(): JSX.Element {
    const hamCl = `${ClHtml.btn} ${ClHtml.btnAct} ${linkSty.cleanbutton}`;
    const btnRef = useRef<HTMLButtonElement>(null);
    return (
        <div className={ClHtml.con}>
            <button
                id={SIDE_ID}
                ref={btnRef}
                type="button"
                className={hamCl}
                aria-label="Menu"
                onClick={() => {
                    toggleSideBar(btnRef.current ?? undefined);
                }}
            ></button>
            <MainNavVD />
            <AccVD />
            <SeaInVD
                tId={IdHtmlTour.seaInHead}
                len={`${Wid.SM250} ${Wid.MD400}`}
                pos={PagPosT.HEAD}
            />
        </div>
    );
}

function ToolTipCon(): JSX.Element {
    return (
        <div>
            <ToolTipInfoVD
                hookName={TT_ID_DEP}
                createCtrl={(ver: string) =>
                    new InfoCtrl(ver, toArrInfoDepRes, QApiCon.culMin)
                }
                createTT={(prpos) => <ToolTipDepCM {...prpos} />}
            />
            <ToolTipInfoVD
                hookName={TT_ID_STR}
                createCtrl={(ver: string) =>
                    new InfoCtrl(ver, toArrInfoStrRes, QApiCon.strMin)
                }
                createTT={(prpos) => <ToolTipStrCM {...prpos} />}
            />
            <TTSimVD />
        </div>
    );
}

function HeadVD(): JSX.Element {
    return (
        <>
            <ToolTipCon />
            <FirInfVD />
            <button
                aria-label="Menu"
                className={`${ClHtml.sOv} ${linkSty.cleanbutton}`}
                onClick={() => {
                    toggleSideBar();
                }}
            ></button>
            <div className={`${ClHtml.navB} ${ClHtml.navBt}`}>
                <Logos />
            </div>
            <nav className={`${ClHtml.navB} ${ClHtml.navBb}`}>
                <NavBar />
            </nav>
            <div className={ClHtml.side}>
                <div className={ClHtml.sMen}>
                    <SideNavVD />
                </div>
            </div>
        </>
    );
}

export default HeadVD;
