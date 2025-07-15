import { memo } from 'preact/compat';
import type { JSX, VNode } from 'preact';

import { UIApiCon } from '@strinf/ts/constants/api/ui_api';
import { ClHtml, Col, Mar } from '@strinf/ts/constants/style/ClHtml';
import ClHtmlI from '@strinf/ts/constants/icon/ClHtml';

import logSty from '@strinf/css/mods/log.module.css';
import LogoDfgVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoDfgVD';
import { D3_BSKY, D3_LN, DFG } from '@strinf/ts/constants/links/collection';

interface SocProps {
    text: string;
    link: string;
    icon: VNode<HTMLElement> | undefined;
}

function SocLink(props: SocProps): JSX.Element {
    const { link, text, icon } = props;
    return (
        <a target="_blank" href={link} rel="noopener">
            <span className={ClHtml.icon}>{icon}</span>
            {text}
        </a>
    );
}

function RowSocial(): JSX.Element {
    // replace null appropriate mastodon logo
    return (
        <div className={`${Col.col} ${Mar.xN5}`}>
            <h3>Social Media</h3>
            <SocLink
                icon={<i className={ClHtmlI.blueS} />}
                text="Bluesky"
                link={D3_BSKY}
            />
            <SocLink
                icon={<i className={ClHtmlI.linkedIn} />}
                text="LinkedIn"
                link={D3_LN}
            />
        </div>
    );
}

function RowMain(): JSX.Element {
    return (
        <div className={`${Col.col} ${Mar.xN5}`}>
            <h3>StrainInfo</h3>
            <a href={UIApiCon.about}>About</a>
            <a href={UIApiCon.team}>Team</a>
            <a href={UIApiCon.news}>News</a>
        </div>
    );
}

function RowHelp(): JSX.Element {
    return (
        <div className={`${Col.col} ${Mar.xN5}`}>
            <h3>Help</h3>
            <a href={UIApiCon.manual}>Manual</a>
            <a href={UIApiCon.contact}>Contact</a>
        </div>
    );
}

function Funds(): JSX.Element {
    return (
        <div className={`${Col.col} ${Mar.xN5} ${logSty.logo}`}>
            <h3>Funded by</h3>
            <a target="_blank" href={DFG} rel="noopener">
                <LogoDfgVD />
            </a>
        </div>
    );
}

function LinksVD(): JSX.Element {
    return (
        <div className={ClHtml.linPar}>
            <div className={ClHtml.row}>
                <RowMain />
                <RowHelp />
                <RowSocial />
                <Funds />
            </div>
        </div>
    );
}

export default memo(LinksVD);
