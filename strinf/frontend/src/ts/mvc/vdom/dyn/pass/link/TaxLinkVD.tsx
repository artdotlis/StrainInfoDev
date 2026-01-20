// SPDX-FileCopyrightText: 2026 Artur Lissin, Leibniz Institute DSMZ-German Collection of Microorganisms and Cell Cultures GmbH
//
// SPDX-License-Identifier: MIT

import type { JSX } from 'preact';
import { lpsn_taxon_id } from '@strinf/ts/constants/links/lpsn';
import { ncbi_taxon_id } from '@strinf/ts/constants/links/ncbi';
import { Font } from '@strinf/ts/constants/style/ClHtml';
import LogoLpsnVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoLpsnVD';
import LogoNcbiVD from '@strinf/ts/mvc/vdom/static/images/logos/LogoNcbiVD';

enum LinkType {
    LPSN = 'lpsn',
    NCBI = 'ncbi',
}

interface TaxLink {
    name: string;
    links: {
        type: LinkType;
        path: string;
    }[];
    infCl?: string;
}

function TaxLinkVD(props: TaxLink): JSX.Element {
    const { links, name, infCl } = props;
    const res: JSX.Element[] = [];
    for (const ele of links) {
        let link = null;
        switch (ele.type) {
            case LinkType.NCBI:
                link = (
                    <a href={ncbi_taxon_id(ele.path)} target="_blank" rel="noopener">
                        <LogoNcbiVD height="22" />
                    </a>
                );
                break;
            case LinkType.LPSN:
                link = (
                    <a href={lpsn_taxon_id(ele.path)} target="_blank" rel="noopener">
                        <LogoLpsnVD height="22" />
                    </a>
                );
                break;
            default:
                link = null;
        }
        if (link != null) {
            res.push(link);
        }
    }
    return (
        <span className={infCl ?? ''}>
            <span className={Font.ita}>{name}</span>
            {res}
        </span>
    );
}

export default TaxLinkVD;
export { LinkType };
