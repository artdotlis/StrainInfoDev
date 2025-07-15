import { memo } from 'preact/compat';
import type { JSX } from 'preact';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import logSty from '@strinf/css/mods/log.module.css';
import LogoLmgVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoLmgVD';
import LogoN4MVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoN4MVD';
import { BCCM_LMG, N4M } from '@strinf/ts/constants/links/collection';

function LogosVD(): JSX.Element {
    return (
        <div className={`${logSty.logo} ${ClHtml.lgP}`}>
            <a href={BCCM_LMG} target="_blank" rel="noopener">
                <LogoLmgVD />
            </a>
            <a target="_blank" href={N4M} rel="noopener">
                <LogoN4MVD />
            </a>
        </div>
    );
}

export default memo(LogosVD);
