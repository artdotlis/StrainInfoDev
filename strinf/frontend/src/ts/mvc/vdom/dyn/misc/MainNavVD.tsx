import type { JSX } from 'preact';
import { useContext, useState } from 'preact/hooks';
import { ClHtml, Mar } from '@strinf/ts/constants/style/ClHtml';
import HeadT from '@strinf/ts/constants/type/HeadT';
import type { BreadCrumbsS } from '@strinf/ts/interfaces/dom/global';
import Known500Error from '@strinf/ts/errors/known/500';
import { UIApiCon } from '@strinf/ts/constants/api/ui_api';
import { MainConGl } from '@strinf/ts/mvc/vdom/state/GlobSt';
import { memo } from 'preact/compat';
import menSty from '@strinf/css/mods/menu.module.css';

const NAV: { [key in keyof typeof HeadT]?: string } = {
    [HeadT.HOME]: 'Home',
    [HeadT.API]: 'Web service',
    [HeadT.STRDB]: 'Strains',
    [HeadT.STRREG]: 'StrainRegistry',
    [HeadT.ABOUT]: 'About',
    [HeadT.NEWS]: 'News',
    [HeadT.TEAM]: 'Team',
    [HeadT.MANUAL]: 'Manual',
    [HeadT.CONTACT]: 'Contact',
    [HeadT.IMPRINT]: 'Imprint',
    [HeadT.SEARCH]: 'Search',
    [HeadT.PASS]: 'Strain',
} as const;

interface HeadTProps {
    name: string;
    link: string;
}

function HeadLinkLiEl({ name, link }: HeadTProps): JSX.Element {
    return (
        <li>
            <a aria-label={`Navigate to ${name}`} href={link}>
                {name}
            </a>
        </li>
    );
}

const NAV_MAP = [
    NAV[HeadT.API],
    NAV[HeadT.STRREG],
    NAV[HeadT.STRDB],
    NAV[HeadT.HOME],
    NAV[HeadT.ABOUT],
    NAV[HeadT.NEWS],
    NAV[HeadT.TEAM],
    NAV[HeadT.MANUAL],
    NAV[HeadT.IMPRINT],
    NAV[HeadT.CONTACT],
    NAV[HeadT.SEARCH],
    NAV[HeadT.PASS],
];

function mapLink(nav: string): string {
    if (NAV_MAP.includes(nav)) {
        return nav;
    }
    throw new Known500Error(`unknown NAV in bread:\n${nav}`);
}

function MainNavVD(): JSX.Element {
    const conf: BreadCrumbsS | undefined = useContext(MainConGl);
    const [act, setAct] = useState<HeadT>(0);
    conf?.breadSet('HEAD_BREAD_CRUMBS')((actI: HeadT) => {
        setAct(actI);
    });
    const name = mapLink(NAV[act] ?? '');
    if (act === HeadT.HOME) {
        return <ul className={ClHtml.navBn}></ul>;
    }
    return (
        <nav className={ClHtml.navBn}>
            <ul className={`${ClHtml.breadC} ${menSty.bread} ${Mar.N0}`}>
                <HeadLinkLiEl name={NAV[HeadT.HOME] ?? ''} link={UIApiCon.index} />
                <li className={ClHtml.act}>{name}</li>
            </ul>
        </nav>
    );
}

export default memo(MainNavVD);
