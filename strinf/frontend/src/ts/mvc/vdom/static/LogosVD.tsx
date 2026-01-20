// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logSty from '@strinf/css/mods/log.module.css';
import { BCCM_LMG, N4M } from '@strinf/ts/constants/links/collection';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import LogoLmgVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoLmgVD';
import LogoN4MVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoN4MVD';
import { memo } from 'preact/compat';

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
