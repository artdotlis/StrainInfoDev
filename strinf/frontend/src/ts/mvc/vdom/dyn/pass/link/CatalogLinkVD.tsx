// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import { Font } from '@strinf/ts/constants/style/ClHtml';

interface LinkProps {
    link: string;
    text: string;
    bold: boolean;
    children?: JSX.Element[] | JSX.Element;
}

function CatalogLinkVD(props: LinkProps): JSX.Element {
    const { link, text, bold, children } = props;
    if (link === '') {
        return (
            <span>
                {text}
                {children}
            </span>
        );
    }
    const clName = bold ? Font.bold : '';
    return (
        <a href={link} target="_blank" rel="noopener">
            <span className={clName} key={0}>
                {text}
                {children}
            </span>
        </a>
    );
}

export default CatalogLinkVD;
