// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import logSty from '@strinf/css/mods/log.module.css';
import { ClHtml } from '@strinf/ts/constants/style/ClHtml';
import FooterVD from '@strinf/ts/mvc/vdom/static/FooterVD';
import LinksVD from '@strinf/ts/mvc/vdom/static/LinksVD';

import LogosVD from '@strinf/ts/mvc/vdom/static/LogosVD';

function FootVD(): JSX.Element {
    return (
        <div className={`${ClHtml.pgFoot} ${logSty.footer}`}>
            <LinksVD />
            <LogosVD />
            <hr />
            <FooterVD />
        </div>
    );
}

export default FootVD;
